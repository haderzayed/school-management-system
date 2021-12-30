<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class teacher extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $guarded=[];

    public function specialization(){

        return $this->belongsTo(specialization::class);
    }

    public function gender(){

        return $this->belongsTo(gender::class);
    }
    public function sections()
    {
        return $this->belongsToMany(section::class,'teacher_section');
    }
}
