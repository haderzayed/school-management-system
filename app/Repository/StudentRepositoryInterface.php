<?php
namespace App\Repository;

interface StudentRepositoryInterface{

    public function getAllStudents();

    public function createStudent();

    public function storeStudent($request);

    public function editStudent($id);

    public function updateStudent($request,$id);

    public function deleteStudent($id);

}
