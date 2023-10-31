<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter Login Form - Code Mo</title>
    <link rel="stylesheet" href="{{asset('public/template/css/login.css')}}">
</head>
<body>
    <div class="container">
        <div class="box box-one">
            <i class="fab fa-twitter"><img src="{{url('public/image/logo/logoblue.png')}}"/></i>
            <h4>Regsiter ATTER</h4>
        </div>
        <div class="box box-two">
            <form>
                <input type="text" placeholder="Nama"/>
                <input type="email" placeholder="Email"/>
                <input type="password" placeholder="Password"/>
            </form>
            <button class="next-btn">Register</button>
        </div>
        <p>Have an account <a href="{{url('login')}}">Login</a></p>
    </div>
</body>
</html>