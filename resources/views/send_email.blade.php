<html>
    <head>
        <title>Email Sending</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <style type="text/css">
            .box{
                width: 600px;
                margin: auto;
                border: 1px solid #ccc ;
            }
            .has-error{
                border-color: #cc0000;
                background-color: #ffff99;
            }
        </style>
    </head>
    <body>
        <div class="container box">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{$message}}</strong>
                    </div>
                @endif

            <form method="post" action="{{url('sendemail/send')}}">
                <h4>Email Sending</h4>
                <div>{!!DNS1D::getBarcodeHTML(8889899, 'C39')!!}</div>
                {{csrf_field()}}
                <div class="form-group">
                    <label>Enter Name</label>
                    <input type="text" name="name" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Enter Email</label>
                    <input type="text" name="email" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Enter Message</label>
                    <textarea name="message" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="send" value="Send" class="btn btn-info">
                </div>
            </form>
        </div>
    </body>
</html>
