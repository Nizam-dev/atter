@extends('template.master_admin')
@push('css')
@endpush
@section('content')
<div class="container mt-2">
    <h5 class="title">
    <a href="{{url('admin/user')}}"><i class="fa fa-arrow-left"></i></a>    
    Edit</h5>
    <div class="card">
        <div class="card-body">
        <form action="{{url('admin/user/'.$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="name" value="{{$data->name}}">
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control" name="username" value="{{$data->username}}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" value="{{$data->email}}">
            </div>
            <div class="form-group">
                <label for="">Bio</label>
                <input type="text" class="form-control" name="bio" value="{{$data->bio}}">
            </div>
            <div class="form-group">
                <label for="">Location</label>
                <input type="text" class="form-control" name="location" value="{{$data->location}}">
            </div>

            <div class="form-group">
                <label for="">Website</label>
                <input type="text" class="form-control" name="website" value="{{$data->website}}">
            </div>

            <div class="form-group">
                <label for="">Foto</label>
                <input type="file" class="form-control" name="foto" >
            </div>
            <button class="btn btn-primary">Simpan</button>
        </form>
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush