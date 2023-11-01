@extends('template.master')
@push('css')
<link rel="stylesheet" href="{{asset('public/template/css/profile_style.css?v='.time()) }}">
@endpush
@section('content')




<div class="grid-toolbar-center">
    <div class="center-input-search">
        <div class="row">
            <div class="col-xs-12">
                <a href="javascript: history.go(-1);"> <i style="font-size:20px;" class="fas fa-arrow-left arrow-style"
                        aria-hidden="true"></i> </a>
                <span class="home-name"> Notifikasi</span>

            </div>
        </div>

        <div class="row">
        
            @foreach($data as $notif)
            <div class="col-md-12 notif mb-1">
                <div class="card py-3 px-2">
                    <div class="row">
                        <div class="col-2">
                            <div class="icon mt-2">
                                    @switch($notif->type)
                                            @case('like')
                                                <i style="color: red;font-size:30px;" class="fa-heart  fas ml-2" aria-hidden="true"></i>
                                                @break
                                            @case('follow')
                                                <i style="font-size:30px;" class="fas fa-user ml-2" aria-hidden="true"></i>
                                                @break
                                            @case('retweet')
                                                <i style="font-size:30px;color: rgb(22, 207, 22);" class="fas fa-retweet ml-2" aria-hidden="true"></i>
                                                @break
                                            @case('comment')
                                                <i style="font-size:30px;" class="far fa-comment ml-2" aria-hidden="true"></i>
                                                @break
                                            @case('reply')
                                                <i style="font-size:30px;" class="far fa-comment ml-2" aria-hidden="true"></i>
                                                @break
                                            @default
                                       @endswitch
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="notify-user">
                                <p>
                                    <a style="position: relative; z-index:1000;" href="{{url('/@'.$notif->username)}}">
                                        <img class="img-user" src="{{asset('public/image/profil/'.$notif->foto)}}" alt="">
                                    </a>

                                </p>
                                <p> <a style="font-weight: 700;
                                    font-size:14px;
                                    position: relative; z-index:1000;" href="{{url('/@'.$notif->username)}}">
                                       {{$notif->name}} </a>
                                       @switch($notif->type)
                                            @case('like')
                                                Liked Your Tweet
                                                @break
                                            @case('follow')
                                                Follow You
                                                @break
                                            @case('retweet')
                                                Retweet You
                                                @break
                                            @case('comment')
                                                Comment Your Tweet
                                                @break
                                            @case('reply')
                                                Reply Your Comment
                                                @break
                                            @default
                                       @endswitch
                                    <span style="font-weight: 500; font-size:11px;" class="float-right">
                                        {{$notif->created_at->diffForHumans()}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</div>

@endsection