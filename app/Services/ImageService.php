<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function upload($imageFile)
    {

        $image_name = uniqid() . '.' . $imageFile->getClientOriginalExtension();
        Storage::disk('public')->put('contacts/images/' . $image_name, file_get_contents($imageFile));
        return 'contacts/images/' . $image_name;
    }

    public function unlink($image)
    {
        if ($image !=null && Storage::disk('public')->exists($image) ) {
            unlink(public_path('storage/'.$image));
        }
    }
}
