<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ImageStorage
{
    private const MAX_BYTES = 5 * 1024 * 1024;

    private const EXTENSIONS = [
        'image/gif' => 'gif',
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    ];

    public function storeDataUrl(?string $value, string $directory): ?string
    {
        if ($value === null || $value === '' || ! str_starts_with($value, 'data:')) {
            return $value;
        }

        if (! preg_match('/^data:([^;,]+);base64,(.+)$/s', $value, $matches)) {
            throw ValidationException::withMessages([
                'image' => 'A imagem enviada não possui um formato válido.',
            ]);
        }

        $mime = strtolower($matches[1]);
        $contents = base64_decode(preg_replace('/\s+/', '', $matches[2]), true);

        if (! isset(self::EXTENSIONS[$mime]) || $contents === false || $contents === '') {
            throw ValidationException::withMessages([
                'image' => 'A imagem enviada não é suportada.',
            ]);
        }

        if (strlen($contents) > self::MAX_BYTES) {
            throw ValidationException::withMessages([
                'image' => 'A imagem deve ter no máximo 5 MB.',
            ]);
        }

        $imageInfo = getimagesizefromstring($contents);
        $detectedMime = is_array($imageInfo) ? strtolower($imageInfo['mime'] ?? '') : '';

        if ($detectedMime !== $mime) {
            throw ValidationException::withMessages([
                'image' => 'O conteúdo do arquivo não corresponde ao formato da imagem.',
            ]);
        }

        $extension = self::EXTENSIONS[$detectedMime];
        $path = trim($directory, '/').'/'.Str::uuid().'.'.$extension;

        if (! Storage::disk('public')->put($path, $contents)) {
            throw ValidationException::withMessages([
                'image' => 'Não foi possível salvar a imagem.',
            ]);
        }

        return '/storage/'.$path;
    }

    public function storeMany(array $values, string $directory): array
    {
        return array_values(array_map(
            fn (mixed $value) => $this->storeDataUrl(is_string($value) ? $value : null, $directory),
            $values
        ));
    }

    public function deletePublicUrl(?string $url): void
    {
        $path = $this->publicUrlToPath($url);

        if ($path !== null) {
            Storage::disk('public')->delete($path);
        }
    }

    public function deletePublicUrls(array $urls): void
    {
        $paths = array_values(array_filter(array_map(
            fn (mixed $url) => $this->publicUrlToPath(is_string($url) ? $url : null),
            $urls
        )));

        if ($paths !== []) {
            Storage::disk('public')->delete($paths);
        }
    }

    private function publicUrlToPath(?string $url): ?string
    {
        if (! is_string($url) || ! str_starts_with($url, '/storage/')) {
            return null;
        }

        $path = ltrim(substr($url, strlen('/storage/')), '/');

        return str_contains($path, '..') ? null : $path;
    }
}
