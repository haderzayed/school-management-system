@extends('layouts.master')
@section('css')

    @toastr_css
    @livewireStyles
@endsection
@section('title')
    {{trans('sections_trans.sections')}}

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">

        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('sections_trans.sections')}}</h4>
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
<button type="button" class="button x-small"  id="create-section" data-toggle="modal" data-target="#section">
    {{trans('sections_trans.add_section')}}
</button>
    <br><br>

@livewire('search-users')

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
                            <th>{{trans('sections_trans.section_name')}}</th>
                            <th>{{trans('classrooms_trans.name')}}</th>
                            <th>{{trans('grades_trans.name')}}</th>
                            <th>{{trans('sections_trans.status')}}</th>
                            <th>{{trans('grades_trans.process')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($sections as $section)
                            <tr>
                                <td> {{$section->name}} </td>
                                <td> {{$section->classroom->class_name}} </td>
                                <td> {{$section->grade->name}}
                                <td>
                                    @if ($section->status === 1)
                                        <label
                                            class="badge badge-success">{{ trans('sections_trans.Status_Section_AC') }}</label>
                                    @else
                                        <label
                                            class="badge badge-danger">{{ trans('sections_trans.Status_Section_No') }}</label>
                                    @endif

                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm fa fa-edit" data-target="#section" data-toggle="modal" onclick="editClassroom({{$section->id}})"
                                            name="{{trans('classrooms_trans.Edit')}} ">
                                    </button>
                                    <a class="btn btn-danger btn-sm fa fa-trash" href="{{route('Sections.delete',$section->id)}}"> </a>

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
<div class="modal" id="section" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"    role="document">
        <div class="modal-body" id="variable_content" >
        </div>

        </div>
</div>






     <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    @livewireScripts
    <script>
        console.log('dd')
         $(document).ready(function() {
            $("#create-section").click(function(event){

                $.ajax({
                    url: '{{route('Sections.create')}}',
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

        function editClassroom(id){

            $.ajax({
                url:'{{url('/Sections/edit')}}' + '/' + id,
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
