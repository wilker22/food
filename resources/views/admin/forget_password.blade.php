<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Forget Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container">
    <h1>Admin Forget Password</h1>
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

    <form class="container" action="{{ route('admin.password_submit') }}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

        </div>
       
        <button type="submit" class="btn btn-primary">E-MAIL PASSWORD RESET LINK</button>
       
    </form>
</body>

</html>