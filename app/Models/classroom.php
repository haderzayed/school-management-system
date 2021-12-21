<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class classroom extends Model
{
    use HasTranslations;

    public $translatable = ['class_name'];

     protected $fillable=[
         'class_name','grade_id'
     ];

     public function grades(){

         return $this->belongsTo(grade::class,'grade_id');
     }
     public function sections(){
         return $this->hasMany(section::class,'id');
     }
}
