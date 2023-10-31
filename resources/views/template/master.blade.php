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
    </style>
    @stack('css')
</head>

<body>
    <!-- This is a modal for welcome the new signup account! -->
    <div id="mine">
        @include('template.leftbar')
        <div class="grid-posts">
            <div class="border-right">
                @yield('content')

                <!-- Modal -->
                <div class="modal fade" id="modalquote" tabindex="-1" role="dialog" aria-labelledby="modalquoteLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" id="formquote">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name='rtwt' placeholder="Quote"
                                            required>
                                    </div>
                                    <button type="submit" class="d-none"></button>
                                </form>
                                <div class="postquote"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="quotesubmit()" class="btn btn-primary">Quote</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!--Comment-->
                <div class="modal fade" id="modalkomen" tabindex="-1" role="dialog" aria-labelledby="modalkomenLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="postkomentar"></div>

                            </div>
                            <div class="modal-footer d-block">

                                <form action="" method="post" id="formkomentar" class="d-block">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name='comment' placeholder="Komentar"
                                            required>

                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Comment</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="box-fixed" id="box-fixed"></div>
            <!-- Tweet php -->
            @include('template.rightbar')
        </div>
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

    <script>
        let onLike = async (el, id) => {
            axios.get(`{{url('like')}}/${id}`).then(() => {

                if ($(el).hasClass('unlike-btn')) {
                    $(el).removeClass('unlike-btn')
                    $(el).find('.mt-icon-reaction').removeClass('d-none')
                    $(el).find('.liked').addClass('d-none')
                    let count = $(el).find('.mt-counter p')
                    if (count.html() == '1') {
                        count.html('')
                    } else {
                        let total = parseInt(count.html())
                        count.html(`${total-1}`)
                    }
                } else {
                    $(el).addClass('unlike-btn')
                    $(el).find('.mt-icon-reaction').addClass('d-none')
                    $(el).find('.liked').removeClass('d-none')
                    let count = $(el).find('.mt-counter p')
                    if (count.html() == '') {
                        count.html('1')
                    } else {
                        let total = parseInt(count.html())
                        count.html(`${total+1}`)
                    }
                    toastr.success("Anda menyukai postingan")

                }

            })
        }

        let retweet = (link) => {
            window.location.href = link;
        }

        let undo_retweet = (link) => {
            window.location.href = link;
        }

        let quotertwt = (el, id) => {
            let e = $(el).parent().parent().parent().parent().parent().parent().parent().parent()
            $(".postquote").empty()
            e.clone(true).appendTo(".postquote");
            $(".postquote").find(".grid-reactions").remove()
            $("#formquote").attr("action", `{{url('quotetweet')}}/${id}`)
            $("#modalquote").modal('show')
        }

        let quotesubmit = () => {
            console.log('fa')
            $("#formquote [type='submit']").click()
        }

        let onfollow = (el, id) => {
            if ($(el).hasClass('follow')) {
                $(el).removeClass('follow').addClass('following')
                $(el).html("following")
            } else {
                $(el).removeClass('following').addClass('follow')
                $(el).html("follow")
            }
            axios.get(`{{url("addfollow")}}/${id} `)
        }

        let onkomen = (el,id) => {
            let e = $(el).parent().parent().parent().parent().parent()
            $(".postkomentar").empty()
            e.clone(true).appendTo(".postkomentar");
            $(".postkomentar").find(".grid-reactions").remove()
            $("#formkomentar").attr("action",`{{url('addkomentar')}}/${id}`)
            $("#modalkomen").modal('show')
        }

        $('.following').hover(
            function () {
                $(this).text('Unfoll');
            },
            function () {
                $(this).text('Following');
            })
    </script>
    @stack('js')
</body>

</html>