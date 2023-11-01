<?php
    $users = App\Models\User::where('users.id','!=',auth()->user()->id)->where('role','!=','admin')
    ->inRandomOrder()->limit(8)
    ->with(['followers','followings'])
    ->get();
?>
<div class="wrapper-right">
    <div style="width: 90%;" class="container">
        <div class="input-group py-2 m-auto pr-5 position-relative">
            <i id="icon-search" class="fas fa-search tryy"></i>
            <input type="text" class="form-control search-input" id="search-input" placeholder="Search Atter">
            <div class="search-result"></div>
        </div>
    </div>
    <div class="box-share">
        <p class="txt-share">
            <strong>Who to follow</strong>
        </p>

        @foreach($users as $u)
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
            <a style="position: relative; z-index:5; color:black" href="{{url('@'.$u->username)}}">
                <img src="{{url('public/image/profil/'.$u->foto)}}" alt="" class="img-share">
            </a>
            <div>
                <p>
                    <a style="position: relative; z-index:5; color:black" href="{{url('@'.$u->username)}}">
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
                    onclick="onfollow(this,'{{$u->id}}')"
                    >
                    {{ $imfollow ? 'Following' : 'Follow' }}
                </button>
            </div>
        </div>
        @endforeach

        <!-- <div class="grid-share">
            <a style="position: relative; z-index:5; color:black" href="tiffiny">
                <img src="assets/images/users/default.jpg" alt="" class="img-share">
            </a>
            <div>
                <p>
                    <a style="position: relative; z-index:5; color:black" href="tiffiny">
                        <strong>Tiffiny Irvin</strong>
                    </a>
                </p>
                <p class="username">@tiffiny <span class="ml-1 follows-you">Follows You</span></p>
                <p></p>
            </div>
            <div>
                <button class="follow-btn follow-btn-m following" data-follow="43" data-user="2">Following</button>
            </div>
        </div> -->

    </div>
</div>