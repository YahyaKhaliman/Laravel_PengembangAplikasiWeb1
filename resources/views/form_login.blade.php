<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
crossorigin="anonymous">
<div class="container ">
    <div class="row" style="padding-top:10px;width:50%;margin:auto">
    <div class="col-12">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{url('action_login')}}" method="POST" class="form-control">
    <div class="col-12 " style="text-align:center"><h3>  Login Page</h3> </div>
    {{ csrf_field() }}
    Username: <input type="text" class="form-control" name="email_text" required=""><br>
    Password :<input type="password" class="form-control" name="password_text" required><br>
            <input type="submit" class="btn btn-info" value="login">
        </form>
    </div>
    </div>
    </div>

