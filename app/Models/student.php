<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class student extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $guarded=[];

    public function gender(){

        return $this->belongsTo(gender::class);
    }
    public function grade(){

        return $this->belongsTo(grade::class);
    }
    public function classroom(){

        return $this->belongsTo(classroom::class,'class_id');
    }
    public function section(){

        return $this->belongsTo(section::class);
    }
    public function images(){

        return $this->morphMany(Image::class,'imageable');
    }
}
