<script src="https://kit.fontawesome.com/38e12cc51b.js" crossorigin="anonymous"></script>
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

    let onkomen = (el, id) => {
        let e = $(el).parent().parent().parent().parent().parent()
        $(".postkomentar").empty()
        e.clone(true).appendTo(".postkomentar");
        $(".postkomentar").find(".grid-reactions").remove()
        $("#formkomentar").attr("action", `{{url('addkomentar')}}/${id}`)
        $("#modalkomen").modal('show')
    }

    let onreplykomen = (el, id) => {
        let e = $(el).parent().parent().parent().parent().parent()
        $(".postreplykomentar").empty()
        e.clone(true).appendTo(".postreplykomentar");
        $(".postreplykomentar").find(".grid-reactions").remove()
        $("#formreplykomentar").attr("action", `{{url('replykomentar')}}/${id}`)
        $("#modalreplykomen").modal('show')
    }

    $('.following').hover(
        function () {
            $(this).text('Unfoll');
        },
        function () {
            $(this).text('Following');
        })

    $("#search-input").on('keyup', () => {
        let searc = $("#search-input").val()
        $('.search-result').empty();
        if (searc != '') {
            axios.post("{{url('search')}}", {
                    'search': searc
                })
                .then((res) => {
                    $('.search-result').empty();
                    $('.search-result').html(res.data.dataresult);
                })
        }


    })
</script>