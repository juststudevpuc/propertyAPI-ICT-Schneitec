<?php

namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class CloudinaryService
{
    protected string $cloudName;
    protected string $apiKey;
    protected string $apiSecret;
    protected string $folder;

    public function __construct()
    {
        $this->cloudName = (string) config('services.cloudinary.cloud_name');
        $this->apiKey    = (string) config('services.cloudinary.api_key');
        $this->apiSecret = (string) config('services.cloudinary.api_secret');
        $this->folder    = (string) config('services.cloudinary.folder', 'cms-propT');
    }

    /**
     * Upload a file to Cloudinary and return standardized metadata.
     */
    public function upload(UploadedFile $file, string $subFolder = 'general', string $resourceType = 'auto'): array
    {
        if (empty($this->cloudName) || empty($this->apiKey) || empty($this->apiSecret)) {
            throw new Exception('Cloudinary credentials are not configured in .env.');
        }

        $timestamp = time();
        $targetFolder = trim("{$this->folder}/{$subFolder}", '/');

        $paramsToSign = [
            'folder'    => $targetFolder,
            'timestamp' => $timestamp,
        ];

        $signature = $this->generateSignature($paramsToSign);

        $endpoint = "https://api.cloudinary.com/v1_1/{$this->cloudName}/{$resourceType}/upload";

        $response = Http::attach(
            'file',
            file_get_contents($file->getRealPath()),
            $file->getClientOriginalName()
        )->post($endpoint, [
            'api_key'   => $this->apiKey,
            'timestamp' => $timestamp,
            'folder'    => $targetFolder,
            'signature' => $signature,
        ]);

        if ($response->failed()) {
            $errorMsg = $response->json('error.message') ?? 'Unknown Cloudinary upload error.';
            throw new Exception("Cloudinary Upload Failed: {$errorMsg}");
        }

        $data = $response->json();

        return [
            'cloudinary_public_id' => $data['public_id'],
            'secure_url'           => $data['secure_url'],
            'resource_type'        => $data['resource_type'] ?? 'image',
            'format'               => $data['format'] ?? $file->extension(),
            'width'                => $data['width'] ?? null,
            'height'               => $data['height'] ?? null,
            'bytes'                => $data['bytes'] ?? $file->getSize(),
        ];
    }

    /**
     * Delete a file from Cloudinary using its public_id.
     */
    public function delete(string $publicId, string $resourceType = 'image'): bool
    {
        // Skip external/seeded Unsplash URLs that aren't hosted on Cloudinary
        if (str_starts_with($publicId, 'external_seed_')) {
            return true;
        }

        $timestamp = time();
        $paramsToSign = [
            'public_id' => $publicId,
            'timestamp' => $timestamp,
        ];

        $signature = $this->generateSignature($paramsToSign);
        $endpoint = "https://api.cloudinary.com/v1_1/{$this->cloudName}/{$resourceType}/destroy";

        $response = Http::asForm()->post($endpoint, [
            'public_id' => $publicId,
            'api_key'   => $this->apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ]);

        return $response->successful() && ($response->json('result') === 'ok' || $response->json('result') === 'not found');
    }

    /**
     * Generate SHA-1 signature required by Cloudinary Signed API.
     */
    protected function generateSignature(array $params): string
    {
        ksort($params);
        $queryString = collect($params)
            ->map(fn ($value, $key) => "{$key}={$value}")
            ->implode('&');

        return sha1($queryString . $this->apiSecret);
    }
}
