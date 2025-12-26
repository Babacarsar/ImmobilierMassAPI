<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['property_id', 'path', 'is_main'];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // URL publique pour le front
    public function getUrlAttribute()
    {
        return asset('storage/'.$this->path);
    }
}
