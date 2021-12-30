<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use App\Models\grade;
use App\Models\section;
use App\Models\teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionsController extends Controller
{
       public function index(){

            $sections=section::all();
           return view('pages.sections.index',compact('sections'));
       }

       public function create(){

           $grades=grade::all();
           $teachers=teacher::all();
           return view('pages.sections.create',compact('grades','teachers'));
      }

      public function classrooms($id){

           $classrooms=classroom::where('grade_id',$id)->pluck( 'class_name','id');
           return $classrooms;
      }

    public function sections($id){

        $sections=section::where('class_id',$id)->pluck('name', 'id');
        return $sections;
    }

      public function store(Request $request){
           $data=$request->validate([
               'section_name_ar'=>'required',
               'section_name_en'=>'required',
               'grade_id'=>'required',
               'class_id'=>'required',
               'teacher_id'=>'required',
           ]);
           if(section::where('name->ar',$data['section_name_ar'])->orWhere('name->en',$data['section_name_en'])->exists()){
               return redirect()->back()->withErrors(trans('main_trans.exists'));
           }
           try{
               $section=new section();
               $section->name=['en' => $data[  'section_name_en'], 'ar' => $data[ 'section_name_ar']];
               $section->grade_id=$data['grade_id'];
               $section->class_id=$data['class_id'];
               $section->save();
               $section->teachers()->attach($request->teacher_id);
               /*section::create([
                    'name' => ['en' => $data[  'section_name_en'], 'ar' => $data[ 'section_name_ar']],
                    'grade_id'=>$data['grade_id'],
                    'class_id'=>$data['class_id'],
                ]);*/
               toastr()->success(trans('main_trans.Added Succsesufly'));
               return redirect()->route('Sections.index');

           }catch (\Exception $exception){
               return $exception;
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

          if(!$request->has('status'))
              $request->request->add(['status'=>0]);

          $data=$request->validate([
              'section_name_ar'=>'required',
              'section_name_en'=>'required',
              'grade_id'=>'required',
              'class_id'=>'required',
              'status'=>'in:0,1',
          ]);


          try{

              section::where('id',$id)->update([
                  'name' => ['en' => $data[  'section_name_en'], 'ar' => $data[ 'section_name_ar']],
                  'grade_id'=>$data['grade_id'],
                  'class_id'=>$data['class_id'],
                  'status'=>$data['status'],
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
