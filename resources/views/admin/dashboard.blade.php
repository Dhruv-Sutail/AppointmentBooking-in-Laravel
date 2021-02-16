@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <a href="{{url('Appointment')}}">
                <div class="card b">
                    <div class="card-header">
                        <h4>Active Appointments</h4>
                        <div class="card-body" >
                            <center>
                                <img src="{{url('/Images/appointment.jpg')}}" width="50%" height="50%" alt="appointments"><br><br><br>
                                <div class="a">Active Appointments are {{ \DB::table('_appoitments')->count()}} </div>
                            </center>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{url('department-category')}}">
            <div class="card b">
                <div class="card-header">
                    <h4>Departments</h4>
                        <div class="card-body" >
                            <center>
                                <img src="{{url('/Images/dept.jpg')}}" width="50%" height="50%" alt="departments"><br><br><br>
                                <div class="a">Departments are {{ \DB::table('departments')->distinct()->count('department')}} </div>
                                <div class="a">Sub Departments are {{ \DB::table('departments')->distinct()->count('sub_department')}} </div>
                            </center>
                        </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{url('role-register')}}">
                <div class="card b">
                    <div class="card-header">
                        <h4>Users</h4>
                        <div class="card-body" >
                            <center>
                                <img src="{{url('/Images/user.jpg')}}" width="50%" height="50%" alt="Users"><br><br>
                                <div class="a">Registered Users are {{ \DB::table('users')->count()}} </div>
                            </center>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
