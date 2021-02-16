@extends('layouts.app')

@section('title')
    Home
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Book Appointment</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success col-md-12" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                        <form action="/save" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="recipient-name" name="civil_id"  class="col-form-label">Civil ID:</label>
                                    <input type="text" class="form-control" id="civil_id"  name="civil_id">
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
                                        @foreach($department as $department)
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
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Refresh</button>
                                <button type="submit" class="btn btn-primary">Book Appointment</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

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
