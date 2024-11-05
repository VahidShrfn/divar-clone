<?php

namespace App\Traits;
use App\Models\BusinessUser;
use App\Models\Discount;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ServiceTrait
{
    public function saveContent($model,$content,$firstPic)
    {
        $ext = $content->guessExtension();
        $path = Str::uuid()->toString() . '.' . $ext;
        $data = [
            "file_name" => $content->getClientOriginalName(),
            "mime_type" => $content->getClientMimeType(),
            "size" => $content->getSize(),
            "url" => Storage::url(Storage::put($path, $content)),
            'first_pic' => $firstPic
        ];
        $model->contents()
            ->create($data);
        return $this;
    }
}
