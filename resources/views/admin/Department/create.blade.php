@extends('layouts.master')
@section('title')
    Departments
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">ADD Departments
                        <a href="{{url('department-category')}}" class="btn btn-primary float-right">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('department-store')}}" method="post">
                        {{csrf_field()}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" name="department" class="form-control" placeholder="Enter Department">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub Department</label>
                                <input type="text" name="sub_department" class="form-control" placeholder="Enter Sub Department">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Maximum Appointments</label>
                                <input type="text" name="max_appoint" class="form-control" placeholder="Enter Maximum Appointments">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info">SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
