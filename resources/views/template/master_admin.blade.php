<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atter</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/twitter.svg">
    <link rel="stylesheet" href="{{asset('public/template/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/template/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/template/css/home_style.css?v='.time()) }}">
    <link rel="stylesheet" href="{{asset('public/template/toastr.css')}}">


    <script src="{{asset('public/template/js/jquery-3.5.1.min.js')}}"></script>
    <style>
        .following,
        .follow {
            font-size: 12px !important;
        }

        .notif:hover .card {
            cursor: pointer;
            background-color: #F9F9F9;
        }

        .postquote .box-tweet , .postkomentar .box-tweet {
            margin-left: 0 !important;
        }

        .postquote ,  .postkomentar{
            border: 1px solid silver;
            border-radius: 10px;
        }
        #mine .grid-posts {
    display: grid;
    grid-template-columns: 100% auto;
    background-color: rgb(255, 255, 255);
    margin-left: 23%;
}
.wrapper-left-elements{
            font-size: 14px;
        }
    </style>
    @stack('css')
</head>

<body>
    <!-- This is a modal for welcome the new signup account! -->
    <div id="mine">
        @include('template.leftbar_admin')
            <div class="grid-posts">
                @yield('content')


            </div>
            <!-- Tweet php -->
    </div>


    <!-- <script src="assets/js/search.js"></script> -->
    <!-- <script src="assets/js/photo.js?v=
													"></script> -->
    <!-- <script type="text/javascript" src="assets/js/hashtag.js"></script> -->
    <!-- <script type="text/javascript" src="assets/js/like.js"></script> -->
    <script src="https://kit.fontawesome.com/38e12cc51b.js" crossorigin="anonymous"></script>
    <!-- <script src="assets/js/jquery-3.4.1.slim.min.js"></script> -->
    <script src="{{asset('public/template/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('public/template/js/popper.min.js')}}"></script>
    <script src="{{asset('public/template/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/template/toastr.min.js')}}"></script>
    <script src="{{asset('public/template/axios.min.js')}}"></script>

    @if(session()->has('success'))
    <script>
        toastr.success("{{session()->get('success')}}")
    </script>
    @endif
    @if(session()->has('error'))
    <script>
        toastr.error("{{session()->get('error')}}")
    </script>
    @endif


    @stack('js')
</body>

</html>