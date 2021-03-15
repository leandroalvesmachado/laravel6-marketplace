<?php

namespace App\Traits;

trait UploadTrait {

    private function imageUpload($images, $imageColumn = null)
    {
        $uploadedImages = [];

        if (is_array($images)) {
            foreach ($images as $image) {
                // upload na pasta products e disco public
                // cria um nome random para o arquivo e já salva com a extensão correta
                $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
            }
        } else {
            $uploadedImages = $images->store('logo', 'public');
        }

        return $uploadedImages;
    }

}