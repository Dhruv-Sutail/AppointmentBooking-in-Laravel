@extends('layouts.master')
@section('title')
    Active Appointments
@endsection

@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/save-appointment" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" name="civil_id" class="col-form-label">Civil ID:</label>
                            <input type="text" class="form-control" id="civil_id" name="civil_id">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" name="client_name" class="col-form-label">Client Name:</label>
                            <input type="text" class="form-control" id="client_name" name="client_name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" name="phone" class="col-form-label">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" name="department" class="col-form-label">Department:</label>
                            <select name="department" id="department" class="form-control input-lg dynamic" data-dependent="sub_department">
                                <option value="">Select Department</option>
                                @foreach($department  as $department)
                                    <option value='{{ $department->department}}'>{{ $department->department }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" name="sub_department" class="col-form-label">Sub Department:</label>
                            <select name="sub_department" id="sub_department" class="form-control input-lg dynamic">
                                <option value="">Select Sub Department</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message-text" name="Description" class="col-form-label">Date:</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" name="email" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Appointment</button>
                    </div>
                </form>
                <?php

              //  Storage::disk('public')->put('test6.png',base64_decode(DNS2D::getBarcodePNG('2323232', "PDF417")));
                if ( isset( $_POST['submit'] ) ) {
                    $a= $civil_id;
                   // dd($a);
                    Storage::disk('public')->put('test7.png',base64_decode(DNS2D::getBarcodePNG($a, "PDF417")));
                }
                ?>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Active Appointments
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                data-target="#exampleModal">ADD
                        </button>
                    </h4>


                    @if (session('status1'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status1') }}
                        </div>
                    @endif

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                            <thead class=" text-primary">
                            <th>
                                Civil ID
                            </th>
                            <th>
                                Client Name
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                Department
                            </th>
                            <th>
                                Sub Department
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                EDIT
                            </th>
                            <th>
                                DELETE
                            </th>
                            </thead>
                            <tbody>
                            @foreach($appoint as $data)
                                <tr>
                                    <td>
                                        {{$data->civil_id}}
                                    </td>
                                    <td>
                                        {{$data->client_name}}
                                    </td>
                                    <td>
                                        {{$data->phone}}
                                    </td>
                                    <td>
                                        {{$data->department}}
                                    </td>
                                    <td>
                                        {{$data->sub_department}}
                                    </td>
                                    <td>
                                        {{$data->date }}
                                    </td>
                                    <td>
                                        {{$data->email }}
                                    </td>
                                    <td>
                                        <a href="{{url('Appointment-edit/'.$data->id)}}" class="btn btn-success">EDIT</a>
                                    </td>
                                    <td>
                                        <form action="{{url('Appointment-delete/'.$data->id)}}" method="post">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable();

            $('.dynamic').change(function(){
                if($(this).val() != '')
                {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('dynamicdependent.fetch') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent},
                        success:function(result)
                        {
                            $('#'+dependent).html(result);
                        }

                    })
                }
            });

            $('#department').change(function(){
                $('#sub_department').val('');
            });
        });
    </script>
@endsection
