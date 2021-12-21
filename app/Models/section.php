<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class section extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable=['name','status','grade_id','class_id'];

    public function classroom(){

        return $this->belongsTo(classroom::class,'class_id');
    }
    public function grade(){

        return $this->belongsTo(grade::class);
    }
}
