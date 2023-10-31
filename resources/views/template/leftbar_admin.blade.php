<div class="wrapper-left">
    <div class="sidebar-left">
        <div class="grid-sidebar" style="margin-top: 12px">
            <div class="icon-sidebar-align">
                <img src="{{url('public/image/logo/logoblue.png')}}" alt="" height="30px" width="30px" />
            </div>
        </div>
        <a href="{{url('admin')}}">
            <div class="grid-sidebar {{request()->is('admin') ? 'bg-active' :'' }}" style="margin-top: 12px">
                <div class="icon-sidebar-align">
                    <img src="{{asset('public/image/icons/tweethome.png')}}" alt="" height="26.25px" width="26.25px" />
                </div>
                <div class="wrapper-left-elements">
                    <a class="{{request()->is('admin') ? 'wrapper-left-active' :'' }}" href="{{url('admin')}}" style="margin-top: 4px;">
                        <strong>Home</strong>
                    </a>
                </div>
            </div>
        </a>
    
        <a href="{{url('admin/tweet')}}">
            <div class="grid-sidebar {{request()->is('admin/tweet') ? 'bg-active' :'' }}">
                <div class="icon-sidebar-align">
                    <img src="{{asset('public/image/icons/edit.png')}}" alt="" height="26.25px" width="26.25px" />
                </div>
                <div class="wrapper-left-elements">
                    <!-- Username -->
                    <a href="{{url('admin/tweet')}}" style="margin-top: 4px" class="{{request()->is('admin/tweet') ? 'wrapper-left-active' :'' }} ">
                        <strong>Tweet</strong>
                    </a>
                </div>
            </div>
        </a>

        <a href="{{url('admin/comments')}}">
            <div class="grid-sidebar {{request()->is('admin/comments') ? 'bg-active' :'' }}">
                <div class="icon-sidebar-align">
                    <img src="{{asset('public/image/icons/messages.png')}}" alt="" height="26.25px" width="26.25px" />
                </div>
                <div class="wrapper-left-elements">
                    <!-- Username -->
                    <a href="{{url('admin/comments')}}" style="margin-top: 4px" class="{{request()->is('admin/comments') ? 'wrapper-left-active' :'' }} ">
                        <strong>Comments</strong>
                    </a>
                </div>
            </div>
        </a>

        <a href="{{url('admin/user')}}">
            <div class="grid-sidebar {{request()->is('admin/user') ? 'bg-active' :'' }}">
                <div class="icon-sidebar-align">
                    <img src="{{asset('public/image/icons/tweetprof.png')}}" alt="" height="26.25px" width="26.25px" />
                </div>
                <div class="wrapper-left-elements">
                    <!-- Username -->
                    <a href="{{url('admin/user')}}" style="margin-top: 4px" class="{{request()->is('admin/user') ? 'wrapper-left-active' :'' }} ">
                        <strong>Users</strong>
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