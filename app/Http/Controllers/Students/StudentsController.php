<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    protected $Student;

    public function __construct(StudentRepositoryInterface $Student )
    {
        $this->Student=$Student;
    }
    public function index(){
        $students=$this->Student->getAllStudents();
        return view('pages.students.index',compact('students'));
    }

    public function create(){

        return $this->Student->createStudent();
    }

    public function store(Request $request){

        return $this->Student->storeStudent($request);
    }
    public function edit($id){

        return $this->Student->editStudent($id);
    }
    public function update( Request $request,$id){

        return $this->Student->updateStudent($request,$id);
    }
    public function destroy($id){

        return $this->Student->deleteStudent($id);
    }
}
