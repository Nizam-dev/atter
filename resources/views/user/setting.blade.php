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
                <span class="home-name">Setting</span>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                            role="tab" aria-controls="nav-home" aria-selected="true">Email</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                            role="tab" aria-controls="nav-profile" aria-selected="false">Password</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form action="{{url('setting/email')}}" method="post" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name='email' value="{{auth()->user()->email}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name='username' value="{{auth()->user()->username}}" required>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary float-right">SIMPAN</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form action="{{url('setting/password')}}" method="post"  class="mt-3">
                        @csrf
                            <div class="form-group">
                                <label for="">Old Password</label>
                                <input type="text" class="form-control" name='oldpassword' reqired>
                            </div>
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="text" class="form-control" name='password' reqired>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary float-right">SIMPAN</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>

@endsection