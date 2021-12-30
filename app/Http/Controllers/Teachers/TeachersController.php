<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher){

        $this->Teacher=$Teacher;
    }

    public function index()
    {
        $Teachers=$this->Teacher->getAllTeachers();
        return view('pages.teachers.index',compact('Teachers'));
    }

    public function create(){

        $specializations =$this->Teacher->getAllSpecializations();
        $genders=$this->Teacher->getAllGenders();
        return view('pages.teachers.create',compact('specializations','genders'));
    }

    public function store(TeacherRequest $request){

        return $this->Teacher->StoreTeachers($request);
    }

    public function edit($id){
        $teacher=$this->Teacher->editTeachers($id);
        $specializations =$this->Teacher->getAllSpecializations();
        $genders=$this->Teacher->getAllGenders();
        return view('pages.teachers.edit',compact('specializations','genders','teacher'));
    }

    public function update(TeacherRequest $request,$id){

     return $this->Teacher->updateTeachers($request,$id);
    }

    public function destroy($id){

        return $this->Teacher->deleteTeachers($id );
    }
}
