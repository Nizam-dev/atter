@extends('template.master')
@push('css')
@endpush
@section('content')
<div class="grid-toolbar-center">
    <div class="center-input-search">
        <div class="input-group-login" id="whathappen">
            <div class="container">
                <div class="part-1">
                    <div class="header">
                        <div class="home">
                            <h2>Home </h2>
                        </div>
                    </div>
                    
                </div>
                <div class="part-2"></div>
            </div>
        </div>
    </div>
</div>

<div class="my-4 bora">
</div>

@foreach($data as $tweet)

<div class="box-tweet feed" style="position: relative;">
    <a href="{{url('status/'.$tweet->id)}}">
        <span style="position:absolute; width:100%; height:100%; top:0;left: 0; z-index: 1;"></span>
    </a>

    @if($tweet->tweet_id)
    <span class="retweed-name"> <i class="fa fa-retweet retweet-name-i" aria-hidden="true"></i>
        <a style="position: relative; z-index:100; color:rgb(102, 117, 130);" href="">
            {{$tweet->name}}
        </a>
        retweeted
    </span>
    @endif

    <div class="grid-tweet">
        <a style="position: relative; z-index:1000" href="{{url('/@'.$tweet->username)}}">
            <img src="{{asset(url('public/image/profil/'.$tweet->foto))}}" alt="" class="img-user-tweet">
        </a>

        <div>
            <p>
                <a style="position: relative; z-index:1000; color:black" href="{{url('/@'.$tweet->username)}}">
                    <strong> {{$tweet->name}}</strong>
                </a>
                <span class="username-twitter">{{'@'.$tweet->username}}</span>
                <span class="username-twitter">{{$tweet->created_at->diffForHumans()}}</span>
            </p>
            <p class="tweet-links">
                <?php
                $twtdt = $tweet->tweet_id ?$tweet->rtwt : $tweet->tweet;
                $twtdt = preg_replace('/(\#)([^\s]+)/', ' <a href="tag/$2">#$2</a> ', $twtdt );
                $twtdt = preg_replace('/(\@)([^\s]+)/', ' <a href="tag/$2">@$2</a> ', $twtdt );
                ?>
                {!! $twtdt  !!} </p>
            <p class="mt-post-tweet">
                @if($tweet->img)
                <img src="{{url('public/image/post/'.$tweet->img)}}" alt="" class="img-post-tweet">
                @endif
            </p>

            @if($tweet->tweet_id)

            <div class="mt-post-tweet comment-post" style="position: relative;">

                <a href="{{url('status/'.$tweet->data_rtwt->id)}}">
                    <span class=""
                        style="position:absolute; width:100%; height:100%; top:0;left: 0; z-index: 2;"></span>
                </a>
                <div class="grid-tweet py-3 ">

                    <a style="position: relative; z-index:1000" href="{{url('/@'.$tweet->data_rtwt->username)}}">
                        <img src="{{url('public/image/profil/'.$tweet->data_rtwt->foto)}}" alt=""
                            class="img-user-tweet">
                    </a>

                    <div class="ml-1">
                        <p>
                            <a style="position: relative; z-index:1000; color:black"
                                href="{{url('/@'.$tweet->data_rtwt->username)}}">
                                <strong> {{ $tweet->data_rtwt->name }} </strong>
                            </a>
                            <span class="username-twitter">{{ '@'.$tweet->data_rtwt->username }} </span>
                            <span class="username-twitter">{{ $tweet->data_rtwt->created_at->diffForHumans() }}</span>
                        </p>
                        <p>
                            {{ $tweet->data_rtwt->tweet }}
                        </p>
                        <p class="mt-post-tweet">
                            @if($tweet->data_rtwt->img)
                            <img src="{{url('public/image/post/'.$tweet->data_rtwt->img)}}" alt=""
                                class="img-post-tweet w-100">
                            @endif
                        </p>

                    </div>

                </div>


            </div>

            @endif

            <div class="grid-reactions">
                <div class="grid-box-reaction">
                    <div class="hover-reaction hover-reaction-comment comment"  onclick="">

                        <i class="far fa-comment" aria-hidden="true"></i>
                        <div class="mt-counter likes-count d-inline-block">
                            <p>{{$tweet->komentar->count() == 0 ? '': $tweet->komentar->count()}} </p>
                        </div>
                    </div>
                </div>
                <div class="grid-box-reaction">


                    <div class="hover-reaction hover-reaction-retweet retweet option dropdown">

                        <i class="fas fa-retweet " type="button"
                            aria-haspopup="true" aria-expanded="false">
                           
                        </i>
                        <div class="mt-counter likes-count d-inline-block">
                            <p>{{$tweet->retweet->count() == 0 ? '' :  $tweet->retweet->count()}}</p>
                        </div>

                    </div>

                    <div class="options">




                    </div>

                </div>

          

                <div class="grid-box-reaction">
                    <a class="hover-reaction hover-reaction-like "
                        onclick="">

                        <i class="fa-heart far mt-icon-reaction" aria-hidden="true"></i>

                        <div class="mt-counter likes-count d-inline-block">
                            <p>{{$tweet->likes->count() == 0 ? '' : $tweet->likes->count() }}</p>
                        </div>
                    </a>


                </div>

                <div class="grid-box-reaction">
                    <div class="hover-reaction hover-reaction-comment">
                        <i class="fas fa-ellipsis-h mt-icon-reaction" aria-hidden="true"></i>
                    </div>
                    <div class="mt-counter">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>



@endforeach

@endsection

@push('js')


@endpush