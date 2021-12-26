<?php
namespace App\Repository;

interface TeacherRepositoryInterface{

    public function getAllTeachers();

    public function getAllSpecializations();

    public function getAllGenders();

    public function  StoreTeachers($request);

    public function editTeachers($id);

    public function  updateTeachers($request , $id);

    public function deleteTeachers( $id);
}
