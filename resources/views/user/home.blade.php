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
                    <div class="text">
                        <form class="" action="{{url('tweet/post')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="inner">
                                <img src="{{asset('public/image/profil/'.auth()->user()->foto)}}" alt="profile photo">
                                <label>
                                    <textarea class="text-whathappen" name="tweet" rows="8" cols="80" maxlength="140"
                                        placeholder="What's happening?" required></textarea>
                                </label>
                            </div>
                            <!-- tmp image upload place -->
                            <div class="position-relative upload-photo">
                                <img class="img-upload-tmp" src="" alt="">
                                <div class="icon-bg">
                                    <i id="#upload-delete-tmp" class="fas fa-times position-absolute upload-delete"
                                        width="100%"></i>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="bottom-container">
                                    <label for="tweet_img" class="ml-3 mb-2 uni">
                                        <i class="fa fa-image item1-pair"></i>
                                    </label>
                                    <input class="tweet_img" id="tweet_img" type="file" name="img" accept="image/*">
                                </div>
                                <div class="hash-box">
                                    <ul style="margin-bottom: 0;"></ul>
                                </div>
                                <div>

                                    <span class="bioCount" id="count">140</span>
                                    <input id="tweet-input" type="submit" value="Tweet" class="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="part-2"></div>
            </div>
        </div>
    </div>
</div>

<div class="my-4">
</div>

@foreach($data as $tweet)

<div class="box-tweet feed" style="position: relative;">
    <a href="">
        <span style="position:absolute; width:100%; height:100%; top:0;left: 0; z-index: 1;"></span>
    </a>

    @if($tweet->tweet_id)
    <span class="retweed-name"> <i class="fa fa-retweet retweet-name-i" aria-hidden="true"></i>
        <a style="position: relative; z-index:100; color:rgb(102, 117, 130);" href="">
            {{$tweet->data_rtwt->user_id == auth()->user()->id ? "You" : $tweet->data_rtwt->name}}
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
                {{$tweet->tweet_id ? $tweet->rtwt : $tweet->tweet}} </p>
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

                    <div>
                        <p>
                            <a style="position: relative; z-index:1000; color:black"
                                href="{{url('/@'.$tweet->data_rtwt->username)}}">
                                <strong> {{ $tweet->data_rtwt->name }} </strong>
                            </a>
                            <span class="username-twitter">{{ $tweet->data_rtwt->name }} </span>
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
                    <div class="hover-reaction hover-reaction-comment comment"  onclick="onkomen(this, '{{$tweet->id}}')">

                        <i class="far fa-comment" aria-hidden="true"></i>
                        <div class="mt-counter likes-count d-inline-block">
                            <p>{{$tweet->komentar->count() == 0 ? '': $tweet->komentar->count()}} </p>
                        </div>
                    </div>
                </div>
                <div class="grid-box-reaction">

                    <?php
                    $imretweet = false;
                    $dataretweet = $tweet->retweet
                    ->where('user_id',auth()->user()->id)
                    ->where('rtwt',null)
                    ->first();
                    if($dataretweet){
                        $imretweet = true;
                    }
                ?>

                    <div
                        class="hover-reaction hover-reaction-retweet {{ $imretweet  ? 'retweeted' : 'retweet' }} option dropdown">

                        <i class="fas fa-retweet " type="button" id="dretwt-{{$tweet->id}}" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="dropdown-menu" aria-labelledby="dretwt-{{$tweet->id}}">

                                @if($imretweet )
                                <a class="dropdown-item"
                                    onclick="undo_retweet(`{{url('undoretweet/'.$tweet->id  ) }}`)">
                                    <i class="fas fa-retweet icon"></i>
                                   Undo Retweet</a>
                                @else
                                <a class="dropdown-item"
                                    onclick="retweet(`{{url('retweet/'.( $tweet->tweet_id ? $tweet->data_rtwt->id : $tweet->id  ))}}`)">
                                    <i class="fas fa-retweet icon"></i>
                                    Retweet</a>
                                @endif

                                <a class="dropdown-item" onclick="quotertwt(this,'{{$tweet->tweet_id ? $tweet->data_rtwt->id : $tweet->id }}')">
                                    <i class="fas fa-pencil-alt icon"></i>
                                    Quote Tweet</a>
                            </div>
                        </i>
                        <div class="mt-counter likes-count d-inline-block">
                            <p>{{$tweet->retweet->count() == 0 ? '' :  $tweet->retweet->count()}}</p>
                        </div>

                    </div>

                    <div class="options">




                    </div>

                </div>

                <?php
                    $imlike = $tweet->likes->where('user_id',auth()->user()->id)->first();
                ?>

                <div class="grid-box-reaction">
                    <a class="hover-reaction hover-reaction-like {{$imlike ? 'unlike-btn' : ''}}"
                        onclick="onLike(this,'{{$tweet->id}}')">

                        <i class="fa-heart far mt-icon-reaction {{$imlike ? 'd-none' : ''}} " aria-hidden="true"></i>
                        <i class="fas fa-heart liked  {{$imlike ? '' : 'd-none'}} "></i>

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
<script src="{{asset('public/template/js/photo.js')}}"></script>

<script>
    $(".text-whathappen").on('keyup', () => {
        var regex = /[#|@](\w+)$/ig;
        let content = $(".text-whathappen").val()
        let countcontent = 140 - content.length;
        $(".bioCount").html(countcontent)
        console.log(content.match(regex))
    })
</script>
@endpush