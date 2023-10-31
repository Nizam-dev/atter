@extends('template.master_admin')
@section('content')
    <div class="container mt-2">
        <div class="card">
            <div class="card-body">
                <h5>Dashboard</h5>
                <div class="row">

                    <div class="col-md-4">
                        <div class="card bg-primary py-4">
                            <div class="card-body text-white">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <i class="fa fa-edit" style="font-size: 30px;"></i>
                                    </div>
                                    <div class="col-9">
                                        <h3>{{$data['postingan']}} Tweet</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-warning py-4">
                            <div class="card-body text-white">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <i class="fa fa-comment" style="font-size: 30px;"></i>
                                    </div>
                                    <div class="col-9">
                                        <h3>{{$data['komentar']}} Comment</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-danger py-4">
                            <div class="card-body text-white">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <i class="fa fa-user" style="font-size: 30px;"></i>
                                    </div>
                                    <div class="col-9">
                                        <h3>{{$data['user']}} User</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection