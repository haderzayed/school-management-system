<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use Illuminate\Http\Request;

class ClassroomsController extends Controller
{
   public function index(){

       $classrooms=classroom::all();
       return view('pages.classrooms.index',compact('classrooms'));
   }
}
