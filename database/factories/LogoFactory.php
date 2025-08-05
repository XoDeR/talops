<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Logo>
 */
class LogoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Use 'public' disc => /storage/app/public
        // Default is 'local' => /storage/app/private
        Storage::disk('public')->makeDirectory('logos');
        $sampleFiles = Storage::disk('public')->files('logo_samples');
        $originalPath = collect($sampleFiles)->random();
        $originalName = basename($originalPath);
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $uuid = Str::uuid();
        $generatedName = "{$uuid}.{$extension}";
        Storage::disk('public')->copy($originalPath, "logos/{$generatedName}");
        return [
            'original_name' => $originalName,
            'name' => $generatedName,
        ];
    }
}
