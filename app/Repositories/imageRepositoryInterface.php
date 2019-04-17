<?php
    namespace App\Repositories;
    use Illuminate\Http\UploadedFile;

        interface ImageRepositoryInterface
        {
            public function save(UploadedFile $image);
        }
