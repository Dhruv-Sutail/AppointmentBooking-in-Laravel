@extends('layouts.master')
@section('title')
    Edit Departments
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Departments
                        <a href="{{url('department-category')}}" class="btn btn-primary float-right">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('department-update/'.$department->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" name="department" class="form-control" value="{{$department->department}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub Department</label>
                                <input type="text" name="sub_department" class="form-control" value="{{$department->sub_department}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Maximum Appointments</label>
                                <input type="text" name="max_appoint" class="form-control" value="{{$department->max_appoint}}">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info">UPDATE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
