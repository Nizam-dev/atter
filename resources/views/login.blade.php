<html>

<head>
    <title>Atter</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" />

    <link rel="stylesheet" href="{{asset('public/template/css/index_style.css?v='.time()) }}">
    <link rel="stylesheet" href="{{asset('public/template/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/template/css/all.min.css')}}">
    <script src="{{asset('public/template/js/jquery-3.5.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/template/toastr.css')}}">


    <link rel="shortcut icon" type="image/png" href="assets/images/twitter.svg">
</head>

<body>
    <main class="twt-main">

        <section class="twt-login">


            <form action="{{url('login')}}" class="login-box" method="POST">
                @csrf
                <input class="input-box" name="email" type="email" placeholder="Email" required>
                <input class="input-box" name="password" type="password" placeholder="Password" required>
                <!-- <a class="login-link" href="#">Forgot password?</a> -->
                <input type="submit" name="login" class="login-btn" value="Log In">
                <div class="con">

                </div>
            </form>

            <div class="slow-login">
                <img class="login-bird" src="{{asset('public/image/logo/logoblue.png')}}" alt="bird">
                <button class="login-small-display signin-btn pri-btn">Log in</button>
                <span class="front-para">See what’s happening in the world right now</span>
                <span class="join">Join Atter Today.</span>
                <button type="button" id="auto" onclick="" class="signup-btn pri-btn" data-toggle="modal"
                    data-target="#exampleModalCenter">
                    Sign Up</button>
                    <a href="{{url('guest')}}" class="signup-btn pri-btn d-block text-center">
                    Join Guest</a>


                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-weight: 700;" class="modal-title" id="exampleModalLongTitle">Sign Up For
                                    Free</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{url('register')}}" method="post">
                                @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" 
                                            aria-describedby="emailHelp" placeholder="Full Name" required>
                                    </div>
                                    <div class="form-group" >

                                        <input type="email" name="email" class="form-control" 
                                            aria-describedby="emailHelp" placeholder="Email Address" required>

                                    </div>
                                    <div class="form-group">

                                        <input type="password" name="password" class="form-control"
                                            id="exampleInputPassword1" placeholder="Password" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>
                </div>


            </div>

        </section>
        <section class="twt-features">
            <div class="features-div">
                <img class="twt-icon" src='https://image.ibb.co/bzvrkp/search_icon.png'>
                <p>Follow your interests.</p>
                <img class="twt-icon" src="https://image.ibb.co/mZPTWU/heart_icon.png">
                <p>Hear what people are talking about.</p>
                <img class="twt-icon" src="https://image.ibb.co/kw2Ad9/conv_icon.png">
                <p>Join the conversation.</p>
            </div>
        </section>
        <footer>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Help Center</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Cookies</a></li>
                <li><a href="#">Ads info</a></li>
                <li><a href="#">Brand</a></li>
                <li><a href="#">Advertise</a></li>
                <li><a href="#">Developers</a></li>
                <li><a href="#">Settings</a></li>
                <li>© 2021 - Atter</li>
                <li style="color:#1DA1F2;"><b>- Developed By Amin Atter -</b></li>
            </ul>
        </footer>
    </main>


    <script src="{{asset('public/template/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('public/template/js/popper.min.js')}}"></script>
    <script src="{{asset('public/template/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/template/toastr.min.js')}}"></script>
    @if(session()->has('success'))
        <script> toastr.success("{{session()->get('success')}}")</script>
    @endif
    @if(session()->has('error'))
        <script> toastr.error("{{session()->get('error')}}")</script>
    @endif
</body>

</html>