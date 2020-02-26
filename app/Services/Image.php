<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageInt;

trait Image
{
    public function resize($width, $height)
    {
        $modelName = class_basename($this->imagetable_type);

        $url = $modelName . '/' . $this->imagetable_id . '/' . $width . 'x' . $height . '/' . basename($this->url);

        $file = Storage::disk('public')->exists($url);

        if (!$file) {
            $image = ImageInt::make(public_path() . '/storage/' . $this->url);
            $image->fit($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });

            $path = $modelName . '/' . $this->imagetable_id . '/' . $width . 'x' . $height . '/' . $image->basename;

            Storage::disk('public')->put($path, (string) $image->encode());

            return Storage::url($path);
        }

        return Storage::url($url);
    }
}