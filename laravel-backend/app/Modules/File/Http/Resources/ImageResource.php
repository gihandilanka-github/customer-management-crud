<?php

namespace App\Modules\File\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $imageSize = $request->image_size ? $request->image_size : 'large';
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image_path' => $this->path,
            'path' => url('storage/images/'.$this->resource_type.'/'.$this->resource_id.'/'.$imageSize.'/'.$this->path),

        ];

    }
}
