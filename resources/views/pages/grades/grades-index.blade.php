@extends('layouts.master')
@section('css')

    @toastr_css
@endsection
@section('title')
    {{trans('main_trans.Grades')}}

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">

        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.Grades')}}</h4>
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


    <button class="btn btn-success m-3" data-target="#formModal" id="create-grade" data-toggle="modal" type="submit">{{trans('grades_trans.add_grade')}}</button>
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
                            <th>{{trans('grades_trans.name')}}</th>
                            <th>{{trans('grades_trans.notes')}}</th>
                            <th>{{trans('grades_trans.process')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($grades as $grade)
                          <tr>
                            <td>{{$grade->name}}</td>
                            <td>{{$grade->notes}}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm fa fa-edit" data-target="#formModal" data-toggle="modal" onclick="editGrade({{$grade->id}})"
                                         name="{{trans('grades_trans.edit')}} ">
                                     </button>

                                <a class="btn btn-danger btn-sm fa fa-trash" href="{{route('grades.delete',$grade->id)}}"> </a>

                            </td>

                        </tr>
                        @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="formModal" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"  id="variable_content" role="document">


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
            $("#create-grade").click(function(event){

                $.ajax({
                    url: '{{route('grades.create')}}',
                    type:"get",
                    success:function(response){
                        console.log(response);
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
