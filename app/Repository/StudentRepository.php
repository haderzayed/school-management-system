<?php
namespace App\Repository;

use App\Models\blood;
use App\Models\gender;
use App\Models\grade;
use App\Models\Image;
use App\Models\my_parents;
use App\Models\nationality;
use App\Models\student;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface{

    public function getAllStudents(){
        return student::all();
    }

    public function createStudent(){

        $data['grades']=grade::all();
        $data['parents']=my_parents::all();
        $data['genders']=gender::all();
        $data['nationalities']=nationality::all();
        $data['bloods']=blood::all();
        return view('pages.students.create',$data);
    }
    public function storeStudent($request){
        $request->validate([
            'email'=>'required|unique:students,email',
            'password' => 'required',
            'name_ar' =>  'required',
            'name_en' =>  'required',
            'gender_id' =>  'required',
            'nationality_id' => 'required',
            'blood_id' =>  'required',
            'date_birth' =>  'required',
            'grade_id' =>  'required',
            'class_id' =>  'required',
            'parent_id' =>  'required',
            'academic_year' =>  'required',
        ]);

        try{
        DB::beginTransaction();
           $student=student::create([
                'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
                'name' => ['en' => $request[  'name_en'], 'ar' => $request[ 'name_ar']],
                'gender_id'=>$request['gender_id'],
                'nationality_id'=>$request['nationality_id'],
                'blood_id'=>$request['blood_id'],
                'date_birth'=>$request['date_birth'],
                'grade_id'=>$request['grade_id'],
                'class_id'=>$request['class_id'],
                'parent_id'=>$request['parent_id'],
                'section_id'=>$request['section_id'],
                'academic_year'=>$request['academic_year'],

            ]);
           if($request->hasfile('photos')){
               foreach ($request->file('photos') as $photo){

                   $name=$photo->getClientOriginalName();
                   $photo->storeAS('attachments/students/'.$student-> name,$name,'upload_attachments');

                   Image::create([
                        'file_name'=>$name,
                        'imageable_id'=>$student->id,
                        'imageable_type'=>' App\Models\student',
                   ]);
               }
           }
            DB::commit();
            toastr()->success(trans('main_trans.Added Succsesufly'));
            return redirect()->route('Students.index');

        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->error(trans('main_trans.sorry error'));
            return back();
        }
    }

    public function editStudent($id){
        $data['grades']=grade::all();
        $data['parents']=my_parents::all();
        $data['genders']=gender::all();
        $data['nationalities']=nationality::all();
        $data['bloods']=blood::all();
        $data['Students']=student::findOrFail($id);
        return view('pages.students.edit',$data);
    }

    public function updateStudent($request,$id){
        student::findOrFail($id);
         $request->validate([
                'email'=>'required|unique',
                'password' => 'required',
                'name_ar' =>  'required',
                'name_en' =>  'required',
                'gender_id' =>  'required',
                'nationality_id' => 'required',
                'blood_id' =>  'required',
                'date_birth' =>  'required',
                'grade_id' =>  'required',
                'class_id' =>  'required',
                'parent_id' =>  'required',
                'academic_year' =>  'required',
        ]);
        try{
            student::where('id',$id)->update([
                'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
                'name' => ['en' => $request[  'name_en'], 'ar' => $request[ 'name_ar']],
                'gender_id'=>$request['gender_id'],
                'nationality_id'=>$request['nationality_id'],
                'blood_id'=>$request['blood_id'],
                'date_birth'=>$request['date_birth'],
                'grade_id'=>$request['grade_id'],
                'class_id'=>$request['class_id'],
                'parent_id'=>$request['parent_id'],
                'section_id'=>$request['section_id'],
                'academic_year'=>$request['academic_year'],

            ]);
            toastr()->success(trans('main_trans.Update Succsesufly'));
            return redirect()->route('Students.index');

        }catch (\Exception $exception){
            toastr()->error(trans('main_trans.sorry error'));
            return back();
        }
    }

    public function deleteStudent($id){
        try {
            student::findOrFail($id);
            student::destroy($id);
            toastr()->success(trans('main_trans.Delete Succsesufly'));
            return back();
        }catch (\Exception $e){
            toastr()->error(trans('main_trans.sorry error'));
            return back();
        }

    }


}
