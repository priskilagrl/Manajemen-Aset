<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'kode', 'name', 'image', 'description'];

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'asset_kategori');
    }
    public function statusAset()
    {
        return $this->belongsToMany(Status::class, 'asset_status', 'asset_id', 'status_id')
            ->withTimestamps();
    }
}
