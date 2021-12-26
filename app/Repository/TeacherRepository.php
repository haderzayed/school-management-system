<?php
namespace App\Repository;

use App\Models\gender;
use App\Models\specialization;
use App\Models\teacher;
use PharIo\Version\Exception;

class TeacherRepository implements TeacherRepositoryInterface{

    public function getAllTeachers(){

        return  teacher::all();
    }
    public function getAllSpecializations(){

        return  specialization::all();
    }
    public function getAllGenders(){

        return  gender::all();
    }
    public function  StoreTeachers($request){


        try{
            teacher::create([
                'email'=>$request['Email'],
                'password'=>$request['Password'],
                'name' => ['en' => $request[  'Name_en'], 'ar' => $request[ 'Name_ar']],
                'specialization_id'=>$request['Specialization_id'],
                'joining_date'=>$request['Joining_Date'],
                'gender_id'=>$request['Gender_id'],
                'address'=>$request['Address'],

            ]);
            toastr()->success(trans('main_trans.Added Succsesufly'));
            return redirect()->route('Teachers.index');

      }catch (\Exception $exception){
          toastr()->error(trans('main_trans.sorry error'));
          return back();
      }
    }

    public function editTeachers($id){

        return teacher::findOrFail($id);
    }

    public function  updateTeachers($request , $id){

      teacher::findOrFail($id);
      try{
          teacher::where('id',$id)->update([
              'email'=>$request['Email'],
              'password'=>$request['Password'],
              'name' => ['en' => $request[  'Name_en'], 'ar' => $request[ 'Name_ar']],
              'specialization_id'=>$request['Specialization_id'],
              'joining_date'=>$request['Joining_Date'],
              'gender_id'=>$request['Gender_id'],
              'address'=>$request['Address'],

          ]);
          toastr()->success(trans('main_trans.Update Succsesufly'));
          return redirect()->route('Teachers.index');

      }catch (\Exception $exception){
          toastr()->error(trans('main_trans.sorry error'));
          return back();
      }
    }

    public function deleteTeachers($id){

         try {
            $teacher=teacher::findOrFail($id);
            if (!$teacher) {
                toastr()->error(trans('sorry this teacher not found'));
                return back();
            }
            teacher::destroy($id);
            toastr()->success(trans('main_trans.Delete Succsesufly'));
            return back();
        }catch (\Exception $e){
            toastr()->error(trans('main_trans.sorry error'));
            return back();
        }
    }

}
