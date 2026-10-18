<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UploadMediaRequest;
use App\Models\MediaAsset;
use App\Services\CloudinaryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaAssetController extends Controller
{
    public function __construct(protected CloudinaryService $cloudinary)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $query = MediaAsset::with('uploader:id,name')->latest();

        if ($request->filled('resource_type')) {
            $query->where('resource_type', $request->string('resource_type'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('alt_text', 'like', "%{$search}%")
                  ->orWhere('cloudinary_public_id', 'like', "%{$search}%");
            });
        }

        return response()->json($query->paginate(24));
    }

    public function store(UploadMediaRequest $request): JsonResponse
    {
        try {
            $asset = DB::transaction(function () use ($request) {
                $subFolder = $request->input('subfolder', 'general');
                $uploadData = $this->cloudinary->upload($request->file('file'), $subFolder);

                return MediaAsset::create([
                    ...$uploadData,
                    'uploaded_by' => $request->user()->id,
                    'alt_text'    => $request->input('alt_text'),
                ]);
            });

            return response()->json([
                'message' => 'Media uploaded successfully.',
                'data'    => $asset,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to upload media asset.',
                'error'   => $e->getMessage(),
            ], 422);
        }
    }

    public function update(Request $request, MediaAsset $mediaAsset): JsonResponse
    {
        $validated = $request->validate([
            'alt_text' => ['required', 'string', 'max:255'],
        ]);

        $mediaAsset->update($validated);

        return response()->json([
            'message' => 'Media metadata updated.',
            'data'    => $mediaAsset,
        ]);
    }

    public function destroy(MediaAsset $mediaAsset): JsonResponse
    {
        try {
            DB::transaction(function () use ($mediaAsset) {
                $this->cloudinary->delete(
                    $mediaAsset->cloudinary_public_id,
                    $mediaAsset->resource_type
                );
                $mediaAsset->delete();
            });

            return response()->json([
                'message' => 'Media asset deleted.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Cannot delete media asset because it is currently linked to active content or Cloudinary failed.',
                'error'   => $e->getMessage(),
            ], 409);
        }
    }
}
