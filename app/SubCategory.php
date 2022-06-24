<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class SubCategory extends Model
{
    use SoftDeletes, Translatable;
    protected $fillable = ['category_id'];

    public $translatedAttributes = ['name'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute()
    {
        if (!$this->category) {
            return null;
        }
        return $this->category->name;
    }



    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
