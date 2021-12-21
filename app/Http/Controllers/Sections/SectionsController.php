<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use App\Models\grade;
use App\Models\section;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
       public function index(){

            $sections=section::all();
           return view('pages.sections.index',compact('sections'));
       }

       public function create(){

           $grades=grade::all();
           return view('pages.sections.create',compact('grades'));
      }

      public function classrooms($id){

           $classrooms=classroom::where('grade_id',$id)->pluck( 'class_name','id');
           return $classrooms;
      }
      public function store(Request $request){

           $data=$request->validate([
               'section_name_ar'=>'required',
               'section_name_en'=>'required',
               'grade_id'=>'required',
               'class_id'=>'required',
           ]);
           if(section::where('name->ar',$data['section_name_ar'])->orWhere('name->en',$data['section_name_en'])->exists()){
               return redirect()->back()->withErrors(trans('main_trans.exists'));
           }
           try{
               section::create([
                   'name' => ['en' => $data[  'section_name_en'], 'ar' => $data[ 'section_name_ar']],
                   'grade_id'=>$data['grade_id'],
                   'class_id'=>$data['class_id'],
               ]);
               toastr()->success(trans('main_trans.Added Succsesufly'));
               return redirect()->route('Sections.index');

           }catch (\Exception $exception){
               toastr()->error(trans('main_trans.sorry error'));
               return back();
           }
      }

      public function edit($id){

           $section=section::find($id);
          $grades=grade::all();
          return view('pages.sections.edit',compact('section','grades'));

      }

      public function update(Request $request , $id){
          $data=$request->validate([
              'section_name_ar'=>'required',
              'section_name_en'=>'required',
              'grade_id'=>'required',
              'class_id'=>'required',
          ]);


          try{

              section::where('id',$id)->update([
                  'name' => ['en' => $data[  'section_name_en'], 'ar' => $data[ 'section_name_ar']],
                  'grade_id'=>$data['grade_id'],
                  'class_id'=>$data['class_id'],
              ]);
              toastr()->success(trans('main_trans.Update Succsesufly'));
              return redirect()->route('Sections.index');

          }catch (\Exception $exception){
              toastr()->error(trans('main_trans.sorry error'));
              return back();
          }
      }

    public function destroy($id){
        try {
            $section =section::find($id);
            if (!$section) {
                toastr()->error(trans('sorry this section not found'));
                return back();
            }
            section::destroy($id);
            toastr()->success(trans('main_trans.Delete Succsesufly'));
            return back();
        }catch (\Exception $e){
            toastr()->error(trans('main_trans.sorry error'));
            return back();
        }

    }

}
