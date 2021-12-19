@extends('layouts.master')
@section('css')

    @toastr_css
@endsection
@section('title')
    {{trans('main_trans.Classroom')}}

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">

        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.Classroom')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

<button type="button" class="button x-small"   data-toggle="modal" data-target="#exampleModal">{{trans('classrooms_trans.add_classroom')}}</button>

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
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                        <tr>
                            <th>{{trans('classrooms_trans.name')}}</th>
                            <th>{{trans('grades_trans.notes')}}</th>
                            <th>{{trans('grades_trans.process')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classrooms as $classroom)
                          <tr>
                            <td> {{$classroom->class_name}}</td>
                            <td>{{$classroom->grades->name}} </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm fa fa-edit" data-target="#formModal" data-toggle="modal"
                                         name="{{trans('classrooms_trans.edit')}} ">
                                     </button>

                                <a class="btn btn-danger btn-sm fa fa-trash" href= ""> </a>

                            </td>

                        </tr>
                        @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- add_modal_class -->
    <div class="modal " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-body"  >

                <form class=" row mb-30" action="{{route('Classrooms.store')}} " method="POST">
                    @csrf
                    <h3 class="pt-5"> {{trans('grades_trans.add_grade')}}</h3>
                    <hr style="width:auto">
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="col">
                                            <label for="Name" class="mr-sm-2">{{ trans('classrooms_trans.class_name_ar') }}:</label>
                                            <input class="form-control" type="text" name="class_name_ar" />
                                        </div>
                                        <div class="col">
                                            <label for="Name" class="mr-sm-2">{{ trans('classrooms_trans.class_name_en') }}:</label>
                                            <input class="form-control" type="text" name="class_name_en" />
                                        </div>
                                        <div class="col">
                                            <label for="Name_en" class="mr-sm-2">{{ trans('grades_trans.name') }}:</label>
                                            <select class="form-control" name="grade">
                                                @foreach($grades as $grade)
                                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="Name_en" class="mr-sm-2">{{ trans('classrooms_trans.Processes') }}:</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('classrooms_trans.delete_row') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="btn btn-success " data-repeater-create type="button" value="{{ trans('classrooms_trans.add_row') }}"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                                <button type="submit" class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                            </div>
                        </div>
                    </div>
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
        console.log('dd')
         $(document).ready(function() {
            $("#create-classroom").click(function(event){

                $.ajax({
                    url: '{{route('Classrooms.create')}}',
                    type:"get",
                    success:function(response){

                        $('#variable_content').html(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });



        });

        function editGrade(id){
            $.ajax({
                url:'{{url('/Grades/edit')}}' + '/' + id,
                type:"get",
                success:function(response){
                    console.log(response);
                    $('#variable_content').html(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>

@endsection
