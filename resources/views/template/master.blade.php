<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atter</title>
    @include('template.style')
    @stack('css')
</head>

<body>
    <!-- This is a modal for welcome the new signup account! -->
    <div id="mine">
        @if(auth()->check())
            @include('template.leftbar')
        @else
            @include('template.leftbar_guest')
        @endif
        <div class="grid-posts">
            <div class="border-right">
                @yield('content')
                @include('template.modal')

            </div>
            <div class="box-fixed" id="box-fixed"></div>
            <!-- Tweet php -->
            @if(auth()->check())
                @include('template.rightbar')
            @else
                @include('template.rightbar_guest')
            @endif
        </div>
    </div>


    @include('template.script')
    @stack('js')
</body>

</html>