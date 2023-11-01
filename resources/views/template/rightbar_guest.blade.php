<?php
    $users = App\Models\User::where('role','!=','admin')
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
                </p>
                <p></p>
            </div>
            <div>
                <button class="follow-btn follow-btn-m 
                      follow" style="font-weight: 700;"
                    onclick=""
                    >
                    Follow
                </button>
            </div>
        </div>
        @endforeach

        

    </div>
</div>