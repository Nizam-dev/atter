<div class="wrapper-left">
    <div class="sidebar-left">
        <div class="grid-sidebar" style="margin-top: 12px">
            <div class="icon-sidebar-align">
                <img src="{{url('public/image/logo/logoblue.png')}}" alt="" height="30px" width="30px" />
            </div>
        </div>
        <a href="{{url('guest')}}">
            <div class="grid-sidebar {{request()->is('guest') ? 'bg-active' :'' }}" style="margin-top: 12px">
                <div class="icon-sidebar-align">
                    <img src="{{asset('public/image/icons/tweethome.png')}}" alt="" height="23.25px" width="23.25px" />
                </div>
                <div class="wrapper-left-elements">
                    <a class="{{request()->is('guest') ? 'wrapper-left-active' :'' }}" href="{{url('guest')}}" style="margin-top: 4px;">
                        <strong>Home</strong>
                    </a>
                </div>
            </div>
        </a>

   
        <a href="{{url('login')}}">
            <div class="grid-sidebar">
                <div class="icon-sidebar-align">
                    <i style="font-size: 23px;" class="fas fa-sign-out-alt"></i>
                </div>
                <div class="wrapper-left-elements">
                    <a href="{{url('login')}}" style="margin-top: 4px">
                        <strong>Login</strong>
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
                    <img src="{{asset('public/image/profil/profil_guest.png')}}" alt="user" class="img-user" />
                </div>
                <div>
                    <p class="name"><strong>Guets</strong></p>
                    <p class="username">Guest</p>
                </div>
                <div class="mt-arrow">
                    <img src="https://i.ibb.co/mRLLwdW/arrow-down.png" alt="" height="18.75px" width="18.75px" />
                </div>
            </div>
        </div>
    </div>
</div>