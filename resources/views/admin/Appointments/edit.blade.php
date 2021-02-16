@extends('layouts.master')
@section('title')
    Edit Appointments
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Appointments</h4>
                    <form action="{{url('Appointment-update/'.$appoint->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" name="civil_id" class="col-form-label">Civil ID:</label>
                                <input type="text" class="form-control" value="{{$appoint->civil_id}}" name="civil_id">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" name="client_name" class="col-form-label">Client Name:</label>
                                <input type="text" class="form-control" value="{{$appoint->client_name}}" id="client_name" name="client_name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" name="phone" class="col-form-label">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{$appoint->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" name="department" class="col-form-label">Department:</label>
                                <input type="text" class="form-control" id="department" name="department" value="{{$appoint->department}}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" name="sub_department" class="col-form-label">Sub Department:</label>
                                <input type="text" class="form-control" id="sub_department" name="sub_department" value="{{$appoint->sub_department}}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" name="date" class="col-form-label">Date:</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{$appoint->date}}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" name="email" class="col-form-label">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{$appoint->email}}">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <a href="{{ url('Appointment') }}" class="btn btn-secondary">BACK</a>
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
