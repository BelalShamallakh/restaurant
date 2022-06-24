<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    use SoftDeletes, Translatable;
    protected $guarded  = [];

    public $translatedAttributes = ['name'];




    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
