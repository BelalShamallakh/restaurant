<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'logo',
        'miniLogo',
        'phone',
        'facebook',
        'twitter',
        'whatsapp',
        'instagram',
        'linkedin',
        'email',
        'blog_name',
        'description',
        'keywords',
        'address',
    ];


    protected $hidden = ['updated_at', 'deleted_at', 'translations'];




    public function getLogoAttribute($image)
    {
        return asset($image);
    }

    public function getMiniLogoAttribute($image)
    {
        return asset($image);
    }


    // For fomated date time
    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];
}
