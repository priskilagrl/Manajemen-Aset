<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AssetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'kode' => $this->kode,
            'name' => $this->name,
            'deskripsi' => $this->description,
            'image' => ($this->image == null) ? null : asset(Storage::url($this->image)),
            'kategori' => $this->kategori->first()->name,
            'status' => $this->statusAset->first()->name,
        ];
    }
}
