<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageGallery extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'image',
    ];

    public function getImageAttribute($image)
    {
        return is_null($image) ? null : asset($image);
    }
}
