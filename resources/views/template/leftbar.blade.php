<div class="wrapper-left">
    <div class="sidebar-left">
        <div class="grid-sidebar" style="margin-top: 12px">
            <div class="icon-sidebar-align">
                <img src="{{url('public/image/logo/logoblue.png')}}" alt="" height="30px" width="30px" />
            </div>
        </div>
        <a href="{{url('home')}}">
            <div class="grid-sidebar {{request()->is('home') ? 'bg-active' :'' }}" style="margin-top: 12px">
                <div class="icon-sidebar-align">
                    <img src="{{asset('public/image/icons/tweethome.png')}}" alt="" height="26.25px" width="26.25px" />
                </div>
                <div class="wrapper-left-elements">
                    <a class="{{request()->is('home') ? 'wrapper-left-active' :'' }}" href="{{url('home')}}" style="margin-top: 4px;">
                        <strong>Home</strong>
                    </a>
                </div>
            </div>
        </a>
        <a href="{{url('notifikasi')}}">
            <div class="grid-sidebar {{request()->is('notifikasi') ? 'bg-active' :'' }}">
                <div class="icon-sidebar-align position-relative">
                    <i class="notify-count"><?php
                       $count =  App\Models\notif::where('notify_for',auth()->user()->id)->where('status',false)->count();
                       echo($count == 0 ? '' : $count);
                    ?></i>
                    <img src="{{asset('public/image/icons/tweetnotif.png')}}" alt="" height="26.25px" width="26.25px" />
                </div>
                <div class="wrapper-left-elements">
                    <a href="{{url('notifikasi')}}" style="margin-top: 4px" class="{{request()->is('notifikasi') ? 'wrapper-left-active' :'' }} ">
                        <strong>Notifications</strong>
                    </a>
                </div>
            </div>
        </a>
        <a href="{{url('@'.auth()->user()->username)}}">
            <div class="grid-sidebar {{request()->is('@'.auth()->user()->username) ? 'bg-active' :'' }}">
                <div class="icon-sidebar-align">
                    <img src="{{asset('public/image/icons/tweetprof.png')}}" alt="" height="26.25px" width="26.25px" />
                </div>
                <div class="wrapper-left-elements">
                    <!-- Username -->
                    <a href="{{url('@'.auth()->user()->username)}}" style="margin-top: 4px" class="{{request()->is('@'.auth()->user()->username) ? 'wrapper-left-active' :'' }} ">
                        <strong>Profile</strong>
                    </a>
                </div>
            </div>
        </a>
        <a href="{{url('setting')}}">
            <div class="grid-sidebar {{request()->is('setting') ? 'bg-active' :'' }}">
                <div class="icon-sidebar-align">
                    <img src="{{asset('public/image/icons/tweetsetting.png')}}" alt="" height="26.25px"
                        width="26.25px" />
                </div>
                <div class="wrapper-left-elements">
                    <a href="{{url('setting')}}" style="margin-top: 4px" class="{{request()->is('setting') ? 'wrapper-left-active' :'' }} ">
                        <strong>Settings</strong>
                    </a>
                </div>
            </div>
        </a>
        <a href="{{url('logout')}}">
            <div class="grid-sidebar">
                <div class="icon-sidebar-align">
                    <i style="font-size: 26px;" class="fas fa-sign-out-alt"></i>
                </div>
                <div class="wrapper-left-elements">
                    <a href="{{url('logout')}}" style="margin-top: 4px">
                        <strong>Logout</strong>
                    </a>
                </div>
            </div>
        </a>
        <button class="button-twittear">
            <strong>Tweet</strong>
        </button>
        <div class="box-user">
            <div class="grid-user">
                <div>
                    <img src="{{asset('public/image/profil/'.auth()->user()->foto)}}" alt="user" class="img-user" />
                </div>
                <div>
                    <p class="name"><strong>{{auth()->user()->name}}</strong></p>
                    <p class="username">{{auth()->user()->username}}</p>
                </div>
                <div class="mt-arrow">
                    <img src="https://i.ibb.co/mRLLwdW/arrow-down.png" alt="" height="18.75px" width="18.75px" />
                </div>
            </div>
        </div>
    </div>
</div>