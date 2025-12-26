<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;


class Property extends Model
{
    protected $fillable = [
        'category_id', 'title', 'slug', 'description', 'price', 
        'location', 'surface', 'rooms', 'status', 'featured'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function mainImage()
    {
        return $this->hasOne(Image::class)->where('is_main', true);
    }

    protected static function booted()
{
    static::deleting(function ($property) {
        foreach ($property->images as $image) {
            if ($image->path) {
                Storage::disk('public')->delete($image->path);
            }
        }
    });
}
}
