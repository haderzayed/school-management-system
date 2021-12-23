<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class my_parents extends Model
{
    use HasTranslations;

    public $translatable = ['father_name','job_father','mother_name','job_mother'];
    public $guarded=[];
}
