@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('students_trans.add_student')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('students_trans.add_student')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post"  action="{{ route('Students.store') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('students_trans.personal_information')}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="name_ar"  class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.email')}} : </label>
                                    <input type="email"  name="email" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students_trans.password')}} :</label>
                                    <input type="password"  name="password" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('students_trans.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                        <option selected disabled>{{trans('students_trans.Choose')}}...</option>
                                        @foreach($genders as $gender)
                                            <option  value="{{ $gender->id }}">{{ $gender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{trans('students_trans.Nationality')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationality_id">
                                        <option selected disabled>{{trans('students_trans.Choose')}}...</option>
                                        @foreach($nationalities as $nal)
                                            <option  value="{{ $nal->id }}">{{ $nal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{trans('students_trans.blood_type')}} : </label>
                                    <select class="custom-select mr-sm-2" name="blood_id">
                                        <option selected disabled>{{trans('students_trans.Choose')}}...</option>
                                        @foreach($bloods as $bg)
                                            <option value="{{ $bg->id }}">{{ $bg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('students_trans.Date_of_Birth')}}  :</label>
                                    <input class="form-control" type="text"  id="datepicker-action" name="date_birth" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                        </div>

                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('students_trans.Student_information')}}</h6><br>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Grade_id">{{trans('students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id">
                                        <option selected disabled>{{trans('students_trans.Choose')}}...</option>
                                        @foreach($grades as $grade)
                                            <option  value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{trans('students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="class_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{trans('students_trans.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{trans('students_trans.parent')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                        <option selected disabled>{{trans('students_trans.Choose')}}...</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->father_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{trans('students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academic_year">
                                        <option selected disabled>{{trans('students_trans.Choose')}}...</option>
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                            <option value="{{ $year}}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>{{trans('students_trans.password')}} :</label>
                                    <input type="file"  accept="image/*" name="photos[]" class="form-control" multiple >
                                </div>
                            </div>
                        </div>
                        <br>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('students_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: `{{url('/Sections/classrooms/')}}/${grade_id}`,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="class_id"]').empty();
                            $.each(data, function (key, value) {
                                 $('select[name="class_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('select[name="class_id"]').on('change', function () {
                var class_id = $(this).val();
                if (class_id) {
                    $.ajax({
                        url:`{{url('/Sections/sections/')}}/${class_id}`,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
