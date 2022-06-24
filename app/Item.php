<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use SoftDeletes, Translatable;
    protected $fillable = [
        'sub_category_id',
        'image',
        'price',
        'calorie',

    ];

    public $translatedAttributes = ['name', 'description'];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }


    public function getSubCategoryNameAttribute()
    {
        if (!$this->subCategory) {
            return null;
        }
        return $this->subCategory->name;
    }



    public function getImageAttribute($image)
    {
        return is_null($image) ? null : asset($image);
    }
}
