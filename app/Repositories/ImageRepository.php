<?php
    namespace App\Repositories;
    use Illuminate\Http\UploadedFile;

    class ImageRepository implements ImageRepositoryInterface{
        public function save(UploadedFile $image)
        {
            $image->store(config('images.path'), 'public');
        }
    }
