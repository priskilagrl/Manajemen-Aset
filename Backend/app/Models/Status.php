<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillable = [
        'name',
        'description',
    ];

    public function asset()
    {
        return $this->belongsToMany(Aset::class, 'asset_status', 'status_id', 'asset_id')
            ->withTimestamps();
    }
}
