<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use App\Models\grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassroomsController extends Controller
{
   public function index(){

       $classrooms=classroom::all();
       $grades=grade::all();
       return view('pages.classrooms.index',compact('classrooms','grades'));
   }

    public function create()
    {
        return view('pages.classrooms.create');
    }
    public function store(Request $request){


           $data=$request->validate([
               'List_Classes.*.class_name_ar'=>'required',
               'List_Classes.*.class_name_en'=>'required',
               'List_Classes.*.grade'=>'required',
           ]);


        try{
            $List_classes = $request->List_Classes;

            foreach ($List_classes as $list_class) {

               classroom::create([
                   'class_name'=>['en' => $list_class['class_name_en'], 'ar' => $list_class['class_name_ar']],
                   'grade_id'=>$list_class['grade'],
               ]);
            }
            toastr()->success(trans('main_trans.Added Succsesufly'));
            return redirect()->back();
        }catch (\Exception $e){
            return $e;
            toastr()->error(trans('main_trans.sorry error'));
            return back();
        }


    }

}
