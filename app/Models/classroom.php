<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
     protected $fillable=[
         'class_name','grade_id'
     ];

     public function grades(){

         return $this->belongsTo(grade::class);
     }
}
