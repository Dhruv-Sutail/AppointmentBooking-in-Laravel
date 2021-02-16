<html>
<head>
    <title>Ajax Dynamic Dependent Dropdown in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box{
            width:600px;
            margin:0 auto;
            border:1px solid #ccc;
        }
    </style>
</head>
<body>
<br />
<div class="container box">
    <h3 align="center">Ajax Dynamic Dependent Dropdown in Laravel</h3><br />
    <div class="form-group">
        <select name="department" id="department" class="form-control input-lg dynamic" data-dependent="sub_department">
            <option value="">Select Department</option>
            @foreach($department as $department)
                <option value='{{ $department->department}}'>{{ $department->department }}</option>
            @endforeach
        </select>
    </div>
    <br />
    <div class="form-group">
        <select name="sub_department" id="sub_department" class="form-control input-lg dynamic">
            <option value="">Select Sub Department</option>
        </select>
    </div>
    <br />
    {{ csrf_field() }}
    <br />
    <br />
</div>
</body>
</html>
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


