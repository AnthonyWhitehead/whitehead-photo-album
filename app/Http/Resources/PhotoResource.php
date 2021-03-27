<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $s3Url = Storage::disk('s3')->temporaryUrl($this->img_path, now()->addMinutes(5));

        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $s3Url,
            'updated_at' => $this->updated_at
        ];
    }
}
