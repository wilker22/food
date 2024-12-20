<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container">
    <h1>Admin Login</h1>
    <!--trantamento de erros-->
        @if ($errors->any())
            @foreach ($errors->all() as $error )
            <li>{{ $error }}</li>
            @endforeach
        @endif

        @if(Session::has('error'))
            <li>{{ Session::get('error') }}</li>
        @endif
        
        @if(Session::has('success'))
            <li>{{ Session::get('success') }}</li>
        @endif
    <!--fim trata erros-->

    <form class="container" action="{{ route('admin.reset_password_submit') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="form-group">
            <label for="exampleInputEmail1">New Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirme New Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>