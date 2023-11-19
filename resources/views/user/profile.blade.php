@extends('template.master')
@push('css')
<link rel="stylesheet" href="{{asset('public/template/css/profile_style.css?v='.time()) }}">
<style>
    .box-tweet {
        margin-left: 0 !important;
    }

    .tweet-links a {
        color: #0056b3;
    }
</style>
@endpush
@section('content')




<div class="grid-toolbar-center">
    <div class="center-input-search">
        <div class="row">
            <div class="col-xs-2">
                <a href="javascript: history.go(-1);"> <i style="font-size:20px;" class="fas fa-arrow-left arrow-style"
                        aria-hidden="true"></i> </a>
            </div>
            <div class="col-xs-10">
                <span class="home-name">{{$user->name}}</span>
                <p class="home-tweets-num">
                    1 Tweets</p>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12">
                <img class="w-100 home-img-cover" src="{{asset('public/image/profil/'.$user->bg)}}" alt="">
            </div>

        </div>

        <div class="row justify-content-between">
            <img class="home-img-user" src="{{asset('public/image/profil/'.$user->foto)}}" alt="">


            @if(auth()->user()->id == $user->id)
            <button class="home-edit-button" data-toggle="modal" data-target="#editprofil">Edit Profile</button>
            @else
            <?php
                $pfollwo = false;
                if($user->followers->where('follower_id',auth()->user()->id)->first()){
                    $pfollwo = true;
                }
            ?>

            <button class="home-edit-button
            {{$pfollwo ? 'following' : 'follow'}}" style="font-weight: 700;" onclick="onfollow(this,'{{$user->id}}')">
                {{$pfollwo ? 'Following' : 'Follow'}}
            </button>
            @endif

            <!-- Modal -->
            <div class="modal fade" id="editprofil" tabindex="-1" role="dialog" aria-labelledby="editprofilLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editprofilLabel">Update Profil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <form action="{{url('updateprofil')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Foto Profil</label>
                                        <input type="file" class="form-control" name="foto" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Background Profil</label>
                                        <input type="file" class="form-control" name="bg" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Bio</label>
                                        <input type="text" class="form-control" name="bio"
                                            value="{{auth()->user()->bio}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Location</label>
                                        <input type="text" class="form-control" name="location"
                                            value="{{auth()->user()->location}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Website</label>
                                        <input type="text" class="form-control" name="website"
                                            value="{{auth()->user()->website}}">
                                    </div>

                                    <button type="submit" id="btn-simpan" class="d-none"></button>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" onclick="document.querySelector('#btn-simpan').click()"
                                class="btn btn-primary">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="home-title">
            <h4>{{$user->name}}</h4>
            <p class="user-handle" style="color: gray;">{{'@'.$user->username}} </p>
            <p class="bio">{{$user->bio}} </p>
        </div>

        <div class="row home-loc-link ml-2">
            <div class="col-md-4">
                <li class=""> <i class="fas fa-map-marker-alt" aria-hidden="true"></i> {{$user->location}}</li>
            </div>
            <div class="col-md-4">
                <li><i class="fas fa-link" aria-hidden="true">{{$user->website}}</i>
                    <a href="{{$user->website}}" target="_blank">
                    </a> </li>
            </div>


        </div>


        <!-- Modal Follow -->
        <div class="modal fade" id="followersprofil" tabindex="-1" role="dialog" aria-labelledby="editprofilLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editprofilLabel">Followers</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        @foreach($followers as $u)
                        <?php
                                $imfollow= false;
                                $followme = false;
                                if($u->followers->where('follower_id',auth()->user()->id)->first()){
                                    $imfollow = true;
                                }
                                if($u->followings->where('follow_id',auth()->user()->id)->first()){
                                    $followme = true;
                                }
                                ?>
                        <div class="grid-share">
                            <a style="position: relative; z-index:5; color:black" href="wilburpotter">
                                <img src="{{url('public/image/profil/'.$u->foto)}}" alt="" class="img-share">
                            </a>
                            <div>
                                <p>
                                    <a style="position: relative; z-index:5; color:black" href="wilburpotter">
                                        <strong>{{$u->name}}</strong>
                                    </a>
                                </p>
                                <p class="username">{{'@'.$u->username}}
                                    <span class="ml-1 follows-you {{ $followme ? '' : 'd-none' }}">Follows You</span>
                                </p>
                                <p></p>
                            </div>
                            <div>
                                <button class="follow-btn follow-btn-m 
                                            {{ $imfollow ? 'following' : 'follow' }}" style="font-weight: 700;"
                                    onclick="onfollow(this,'{{$u->id}}')">
                                    {{ $imfollow ? 'Following' : 'Follow' }}
                                </button>
                            </div>
                        </div>
                        @endforeach


                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Follow -->
        <div class="modal fade" id="followingprofil" tabindex="-1" role="dialog" aria-labelledby="editprofilLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="editprofilLabel">Followers</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        @foreach($following as $u)
                        <?php
                                $imfollow= false;
                                $followme = false;
                                if($u->followers->where('follower_id',auth()->user()->id)->first()){
                                    $imfollow = true;
                                }
                                if($u->followings->where('follow_id',auth()->user()->id)->first()){
                                    $followme = true;
                                }
                                ?>
                        <div class="grid-share">
                            <a style="position: relative; z-index:5; color:black" href="wilburpotter">
                                <img src="{{url('public/image/profil/'.$u->foto)}}" alt="" class="img-share">
                            </a>
                            <div>
                                <p>
                                    <a style="position: relative; z-index:5; color:black" href="wilburpotter">
                                        <strong>{{$u->name}}</strong>
                                    </a>
                                </p>
                                <p class="username">{{'@'.$u->username}}
                                    <span class="ml-1 follows-you {{ $followme ? '' : 'd-none' }}">Follows You</span>
                                </p>
                                <p></p>
                            </div>
                            <div>
                                <button class="follow-btn follow-btn-m 
                                            {{ $imfollow ? 'following' : 'follow' }}" style="font-weight: 700;"
                                    onclick="onfollow(this,'{{$u->id}}')">
                                    {{ $imfollow ? 'Following' : 'Follow' }}
                                </button>
                            </div>
                        </div>
                        @endforeach


                    </div>

                </div>
            </div>
        </div>


        <div class="row home-follow ml-2 mt-1">
            <div class="col-md-3">
                <div class="count-following-i" data-toggle="modal" data-target="#followingprofil">
                    <span class="home-follow-count count-following"> {{$user->followings->count()}}</span>
                    Followings</div>
            </div>
            <div class="col-md-3">
                <div class="count-followers-i" data-toggle="modal" data-target="#followersprofil">
                    <span class="home-follow-count count-followers">{{$user->followers->count()}}</span>
                    Followers</div>
            </div>
        </div>

        <ul class="nav nav-tabs nav-justified mt-3" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Tweets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Media</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Likes</a>
            </li>
        </ul>

        <!-- user tweet -->

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                @foreach($data as $tweet)
                <?php
                        $notmedia = true;
                        if($tweet->img != null){
                            $notmedia = false;
                        }
                        if($tweet->tweet_id && $tweet->data_rtwt->img != null){
                            $notmedia = false;
                        }
                    ?>
                @if($notmedia)

                <div class="box-tweet feed" style="position: relative;">
                    <a href="{{url('status/'.$tweet->id)}}">
                        <span style="position:absolute; width:100%; height:100%; top:0;left: 0; z-index: 1;"></span>
                    </a>

                    @if($tweet->tweet_id)
                    <span class="retweed-name"> <i class="fa fa-retweet retweet-name-i" aria-hidden="true"></i>
                        <a style="position: relative; z-index:100; color:rgb(102, 117, 130);" href="">
                            {{$tweet->user_id == auth()->user()->id ? "You" : $tweet->name}}
                        </a>
                        retweeted
                    </span>
                    @endif

                    <div class="grid-tweet">
                        <a style="position: relative; z-index:1000" href="{{url('/@'.$tweet->username)}}">
                            <img src="{{asset(url('public/image/profil/'.$tweet->foto))}}" alt=""
                                class="img-user-tweet">
                        </a>

                        <div>
                            <p>
                                <a style="position: relative; z-index:1000; color:black"
                                    href="{{url('/@'.$tweet->username)}}">
                                    <strong> {{$tweet->name}}</strong>
                                </a>
                                <span class="username-twitter">{{'@'.$tweet->username}}</span>
                                <span class="username-twitter">{{$tweet->created_at->diffForHumans()}}</span>
                            </p>

                            <p class="tweet-links">
                                <?php
                                    $twtdt = $tweet->tweet_id ? $tweet->rtwt : $tweet->tweet;
                                    $twtdt = preg_replace('/(\#)([^\s]+)/', ' <a href="tag/$2">#$2</a> ', $twtdt );
                                    $twtdt = preg_replace('/(\@)([^\s]+)/', ' <a href="tag/$2">@$2</a> ', $twtdt );
                                    ?>
                                {!! $twtdt !!} </p>

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

                                    <a style="position: relative; z-index:1000"
                                        href="{{url('/@'.$tweet->data_rtwt->username)}}">
                                        <img src="{{url('public/image/profil/'.$tweet->data_rtwt->foto)}}" alt=""
                                            class="img-user-tweet">
                                    </a>

                                    <div class="ml-2">
                                        <p>
                                            <a style="position: relative; z-index:1000; color:black"
                                                href="{{url('/@'.$tweet->data_rtwt->username)}}">
                                                <strong> {{ $tweet->data_rtwt->name }} </strong>
                                            </a>
                                            <span class="username-twitter">{{ $tweet->data_rtwt->name }} </span>
                                            <span
                                                class="username-twitter">{{ $tweet->data_rtwt->created_at->diffForHumans() }}</span>
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
                                    <div class="hover-reaction hover-reaction-comment comment"
                                        onclick="onkomen(this, '{{$tweet->id}}')">

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

                                        <i class="fas fa-retweet " type="button" id="dretwt-{{$tweet->id}}"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <div class="dropdown-menu" aria-labelledby="dretwt-{{$tweet->id}}">

                                                @if($imretweet )
                                                <a class="dropdown-item" onclick="">
                                                    <i class="fas fa-retweet icon"></i>
                                                    Undo Retweet</a>
                                                @else
                                                <a class="dropdown-item"
                                                    onclick="retweet(`{{url('retweet/'.( $tweet->tweet_id ? $tweet->data_rtwt->id : $tweet->id  ))}}`)">
                                                    <i class="fas fa-retweet icon"></i>
                                                    Retweet</a>
                                                @endif

                                                <a class="dropdown-item"
                                                    onclick="quotertwt(this,'{{$tweet->tweet_id ? $tweet->data_rtwt->id : $tweet->id }}')">
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

                                        <i class="fa-heart far mt-icon-reaction {{$imlike ? 'd-none' : ''}} "
                                            aria-hidden="true"></i>
                                        <i class="fas fa-heart liked  {{$imlike ? '' : 'd-none'}} "></i>

                                        <div class="mt-counter likes-count d-inline-block">
                                            <p>{{$tweet->likes->count() == 0 ? '' : $tweet->likes->count() }}</p>
                                        </div>
                                    </a>


                                </div>

                                <div class="grid-box-reaction">
                                    <div class="hover-reaction hover-reaction-comment">

                                        <i class="fas fa-ellipsis-h mt-icon-reaction" type="button"
                                            id="dreopt-{{$tweet->id}}" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <div class="dropdown-menu" aria-labelledby="dreopt-{{$tweet->id}}">
                                                <?php
                                                                $twtdt = $tweet->tweet_id ? $tweet->rtwt : $tweet->tweet;
                                                            ?>
                                                @if(auth()->user()->id == $tweet->user_id)
                                                <a class="dropdown-item"
                                                    onclick="oneditPost('{{$tweet->id}}','{{$twtdt}}')">
                                                    <i class="fas fa-edit icon"></i>
                                                    Edit</a>

                                                <a class="dropdown-item"
                                                    onclick="ondeletePost(`{{url('tweet/delete/'.$tweet->id)}}`)">
                                                    <i class="fas fa-trash icon"></i>
                                                    Delete</a>
                                                @endif

                                            </div>

                                        </i>
                                    </div>
                                    <div class="mt-counter">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>


                @endif
                @endforeach

            </div>

            <!-- user media -->

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                @foreach($data as $tweet)
                <?php
                        $notmedia = true;
                        if($tweet->img != null){
                            $notmedia = false;
                        }
                        if($tweet->tweet_id && $tweet->data_rtwt->img != null){
                            $notmedia = false;
                        }
                    ?>
                @if(!$notmedia)

                <div class="box-tweet feed" style="position: relative;">
                    <a href="{{url('status/'.$tweet->id)}}">
                        <span style="position:absolute; width:100%; height:100%; top:0;left: 0; z-index: 1;"></span>
                    </a>

                    @if($tweet->tweet_id)
                    <span class="retweed-name"> <i class="fa fa-retweet retweet-name-i" aria-hidden="true"></i>
                        <a style="position: relative; z-index:100; color:rgb(102, 117, 130);" href="">
                            {{$tweet->user_id == auth()->user()->id ? "You" : $tweet->name}}
                        </a>
                        retweeted
                    </span>
                    @endif

                    <div class="grid-tweet">
                        <a style="position: relative; z-index:1000" href="{{url('/@'.$tweet->username)}}">
                            <img src="{{asset(url('public/image/profil/'.$tweet->foto))}}" alt=""
                                class="img-user-tweet">
                        </a>

                        <div>
                            <p>
                                <a style="position: relative; z-index:1000; color:black"
                                    href="{{url('/@'.$tweet->username)}}">
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
                                {!! $twtdt !!} </p>
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

                                    <a style="position: relative; z-index:1000"
                                        href="{{url('/@'.$tweet->data_rtwt->username)}}">
                                        <img src="{{url('public/image/profil/'.$tweet->data_rtwt->foto)}}" alt=""
                                            class="img-user-tweet">
                                    </a>

                                    <div class="ml-2">
                                        <p>
                                            <a style="position: relative; z-index:1000; color:black"
                                                href="{{url('/@'.$tweet->data_rtwt->username)}}">
                                                <strong> {{ $tweet->data_rtwt->name }} </strong>
                                            </a>
                                            <span class="username-twitter">{{ $tweet->data_rtwt->name }} </span>
                                            <span
                                                class="username-twitter">{{ $tweet->data_rtwt->created_at->diffForHumans() }}</span>
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
                                    <div class="hover-reaction hover-reaction-comment comment"
                                        onclick="onkomen(this, '{{$tweet->id}}')">

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

                                        <i class="fas fa-retweet " type="button" id="dretwt-{{$tweet->id}}"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <div class="dropdown-menu" aria-labelledby="dretwt-{{$tweet->id}}">

                                                @if($imretweet )
                                                <a class="dropdown-item" onclick="">
                                                    <i class="fas fa-retweet icon"></i>
                                                    Undo Retweet</a>
                                                @else
                                                <a class="dropdown-item"
                                                    onclick="retweet(`{{url('retweet/'.( $tweet->tweet_id ? $tweet->data_rtwt->id : $tweet->id  ))}}`)">
                                                    <i class="fas fa-retweet icon"></i>
                                                    Retweet</a>
                                                @endif

                                                <a class="dropdown-item"
                                                    onclick="quotertwt(this,'{{$tweet->tweet_id ? $tweet->data_rtwt->id : $tweet->id }}')">
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

                                        <i class="fa-heart far mt-icon-reaction {{$imlike ? 'd-none' : ''}} "
                                            aria-hidden="true"></i>
                                        <i class="fas fa-heart liked  {{$imlike ? '' : 'd-none'}} "></i>

                                        <div class="mt-counter likes-count d-inline-block">
                                            <p>{{$tweet->likes->count() == 0 ? '' : $tweet->likes->count() }}</p>
                                        </div>
                                    </a>


                                </div>

                                <div class="grid-box-reaction">
                                    <div class="hover-reaction hover-reaction-comment">

                                        <i class="fas fa-ellipsis-h mt-icon-reaction" type="button"
                                            id="dreopt-{{$tweet->id}}" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <div class="dropdown-menu" aria-labelledby="dreopt-{{$tweet->id}}">
                                                <?php
                                                                $twtdt = $tweet->tweet_id ? $tweet->rtwt : $tweet->tweet;
                                                            ?>
                                                @if(auth()->user()->id == $tweet->user_id)
                                                <a class="dropdown-item"
                                                    onclick="oneditPost('{{$tweet->id}}','{{$twtdt}}')">
                                                    <i class="fas fa-edit icon"></i>
                                                    Edit</a>

                                                <a class="dropdown-item"
                                                    onclick="ondeletePost(`{{url('tweet/delete/'.$tweet->id)}}`)">
                                                    <i class="fas fa-trash icon"></i>
                                                    Delete</a>
                                                @endif

                                            </div>

                                        </i>

                                    </div>
                                    <div class="mt-counter">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>


                @endif
                @endforeach


            </div>
            <!-- user likes -->
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">


                @foreach($datalikes as $tweet)

                <div class="box-tweet feed" style="position: relative;">
                    <a href="{{url('status/'.$tweet->id)}}">
                        <span style="position:absolute; width:100%; height:100%; top:0;left: 0; z-index: 1;"></span>
                    </a>

                    @if($tweet->tweet_id)
                    <span class="retweed-name"> <i class="fa fa-retweet retweet-name-i" aria-hidden="true"></i>
                        <a style="position: relative; z-index:100; color:rgb(102, 117, 130);" href="">
                            {{$tweet->user_id == auth()->user()->id ? "You" : $tweet->name}}
                        </a>
                        retweeted
                    </span>
                    @endif

                    <div class="grid-tweet">
                        <a style="position: relative; z-index:1000" href="{{url('/@'.$tweet->username)}}">
                            <img src="{{asset(url('public/image/profil/'.$tweet->foto))}}" alt=""
                                class="img-user-tweet">
                        </a>

                        <div>
                            <p>
                                <a style="position: relative; z-index:1000; color:black"
                                    href="{{url('/@'.$tweet->username)}}">
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
                                {!! $twtdt !!} </p>
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

                                    <a style="position: relative; z-index:1000"
                                        href="{{url('/@'.$tweet->data_rtwt->username)}}">
                                        <img src="{{url('public/image/profil/'.$tweet->data_rtwt->foto)}}" alt=""
                                            class="img-user-tweet">
                                    </a>

                                    <div class="ml-2">
                                        <p>
                                            <a style="position: relative; z-index:1000; color:black"
                                                href="{{url('/@'.$tweet->data_rtwt->username)}}">
                                                <strong> {{ $tweet->data_rtwt->name }} </strong>
                                            </a>
                                            <span class="username-twitter">{{ $tweet->data_rtwt->name }} </span>
                                            <span
                                                class="username-twitter">{{ $tweet->data_rtwt->created_at->diffForHumans() }}</span>
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
                                    <div class="hover-reaction hover-reaction-comment comment">

                                        <i class="far fa-comment" aria-hidden="true"></i>
                                        <div class="mt-counter likes-count d-inline-block">
                                            <p> </p>
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

                                        <i class="fas fa-retweet " type="button" id="dretwt-{{$tweet->id}}"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <div class="dropdown-menu" aria-labelledby="dretwt-{{$tweet->id}}">

                                                @if($imretweet )
                                                <a class="dropdown-item" onclick="">
                                                    <i class="fas fa-retweet icon"></i>
                                                    Undo Retweet</a>
                                                @else
                                                <a class="dropdown-item"
                                                    onclick="retweet(`{{url('retweet/'.( $tweet->tweet_id ? $tweet->data_rtwt->id : $tweet->id  ))}}`)">
                                                    <i class="fas fa-retweet icon"></i>
                                                    Retweet</a>
                                                @endif

                                                <a class="dropdown-item"
                                                    onclick="quotertwt(this,'{{$tweet->tweet_id ? $tweet->data_rtwt->id : $tweet->id }}')">
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

                                        <i class="fa-heart far mt-icon-reaction {{$imlike ? 'd-none' : ''}} "
                                            aria-hidden="true"></i>
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

            </div>
        </div>

    </div>
</div>

@endsection