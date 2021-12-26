@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('teachers_trans.teachers_list')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('teachers_trans.teachers_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('Teachers.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('teachers_trans.add_teachers') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('teachers_trans.Name_Teacher')}}</th>
                                            <th>{{trans('teachers_trans.Gender')}}</th>
                                            <th>{{trans('teachers_trans.Joining_Date')}}</th>
                                            <th>{{trans('teachers_trans.specialization')}}</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($Teachers as $Teacher)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{$Teacher->name}}</td>
                                                <td>{{$Teacher->gender->name}}</td>
                                                <td>{{$Teacher->joining_date}}</td>
                                                <td>{{$Teacher->specialization->name}}</td>
                                                <td>
                                                    <a href="{{route('Teachers.edit',$Teacher->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('Teachers.delete',$Teacher->id)}}"  class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>

                                         @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
