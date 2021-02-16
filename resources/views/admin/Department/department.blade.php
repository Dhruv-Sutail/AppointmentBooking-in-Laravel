@extends('layouts.master')
@section('title')
    Departments
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Departments
                        <a href="{{url('Add-Department')}}" class="btn btn-primary float-right">ADD</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Sub Department</th>
                                <th>Max Appointments</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($department as $item)
                                <tr>
                                    <input type="hidden" class="depdeleteval" value="{{$item->id}}">
                                    <td>{{$item->department}}</td>
                                    <td>{{$item->sub_department}}</td>
                                    <td>{{$item->max_appoint}}</td>
                                    <td>
                                        <a href="{{url('department-edit/'.$item->id)}}" class="btn btn-info">EDIT</a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger deptdeletebtn">DELETE</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready( function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#dataTable').DataTable();

            $('.deptdeletebtn').click(function (e) {
                e.preventDefault();

                var delete_id = $(this).closest("tr").find('.depdeleteval').val();
                //alert(delete_id);

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, You will not be able Fetch the Department Back ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {

                            var data = {
                              "_token" : $('input[name="_token"]').val(),
                                "id": delete_id,
                            };
                            $.ajax({
                                type:"DELETE",
                                url:'/department-delete/'+delete_id,
                                data:data,
                                success: function (response) {
                                    swal(response.status,{
                                        icon: "success",
                                    })
                                        .then((result) => {
                                            location.reload();
                                        });
                                }
                            });

                        }
                    });
            });
        });
    </script>
@endsection
