@extends('layouts.master')
@section('title')
    Register Roles
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Registered Users</h4>
                    @if (session('status2'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status2') }}
                        </div>
                    @endif
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
                                Name
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                UserType
                            </th>
                            <th>
                                EDIT
                            </th>
                            <th>
                                DELETE
                            </th>
                            </thead>
                            <tbody>
                                @foreach($users as $row)
                                    <tr>
                                        <td>
                                            {{$row->name}}
                                        </td>
                                        <td>
                                            {{$row->phone}}
                                        </td>
                                        <td>
                                            {{$row->email}}
                                        </td>
                                        <td>
                                            -{{$row->usertype}}
                                        </td>
                                        <td>
                                            <a href="/role-edit/{{$row->id}}" class="btn btn-success">EDIT</a>
                                        </td>
                                        <td>
                                            <form action="/role-delete/{{$row->id}}" method="post">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
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
        } );
    </script>
@endsection
