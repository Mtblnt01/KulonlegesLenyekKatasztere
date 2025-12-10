<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadGalleryRequest;
use App\Models\Creature;
use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Get all gallery images for a creature
     */
    public function index(Creature $creature): JsonResponse
    {
        $images = $creature->galleryImages;

        return response()->json([
            'message' => 'Gallery images retrieved successfully',
            'data' => $images,
        ]);
    }

    /**
     * Upload a new image to creature's gallery
     */
    public function store(UploadGalleryRequest $request, Creature $creature): JsonResponse
    {
        $validated = $request->validated();

        // Store the uploaded image
        $path = $request->file('image')->store('gallery', 'public');

        // Create the gallery image record
        $galleryImage = $creature->galleryImages()->create([
            'image_path' => $path,
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);

        // Add full URL to the response
        $galleryImage->image_url = Storage::url($path);

        return response()->json([
            'message' => 'Image uploaded successfully',
            'data' => $galleryImage,
        ], 201);
    }
}
