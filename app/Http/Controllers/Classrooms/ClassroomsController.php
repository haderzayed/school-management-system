<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use App\Models\grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

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

            toastr()->error(trans('main_trans.sorry error'));
            return back();
        }


    }
    public function edit($id){

        $classroom=classroom::find($id);
        $grades=grade::all();
        return view('pages.classrooms.edit',compact('classroom','grades'));
    }

    public function update(Request $request,$id)
    {

       $data=$request->validate([
           'class_name_ar'=>'string',
           'class_name_en'=>'string',
       ]);

       try{
           $classroom=classroom::find($id);
           if(!$classroom){
               toastr()->error(trans('sorry this classroom not found'));
               return back();
           }

           classroom::where('id',$id)->update([
               'class_name'=>['en' => $request['class_name_en'], 'ar' => $request['class_name_ar']],
               'grade_id'=>$request['grade'],
           ]);
           toastr()->success(trans('main_trans.Update Succsesufly'));
           return redirect()->route('Classrooms.index');
       }catch (\Exception $exception){

           toastr()->error(trans('main_trans.sorry error'));
           return back();
       }
    }

    public function destroy($id){
       try {
           $classroom = classroom::find($id);
           if (!$classroom) {
               toastr()->error(trans('sorry this classroom not found'));
               return back();
           }
           classroom::destroy($id);
           toastr()->success(trans('main_trans.Delete Succsesufly'));
           return back();
       }catch (\Exception $e){
           toastr()->error(trans('main_trans.sorry error'));
           return back();
       }

    }

    public function delete_all(Request $request){
      try{
          $delete_all_id=explode(",",$request->delete_all_id);

          classroom::whereIn('id',$delete_all_id)->delete();
          toastr()->success(trans('main_trans.Delete Succsesufly'));
          return back();
      }catch (\Exception $e){
          toastr()->error(trans('main_trans.sorry error'));
          return back();
      }


    }

    public function filter_classrooms(Request $request){

       $grades=grade::all();
       $classrooms=classroom::all();
       $grade_id=$request->grade_id;
       $search=classroom::where('grade_id',$grade_id)->get();
        return view('pages.classrooms.index',compact('grades','classrooms') )->withDetails($search);
    }




}
