@extends('template.master_admin')
@push('css')
@endpush
@section('content')
<div class="container mt-2">
    <h5 class="title">
    <a href="{{url('admin/tweet')}}"><i class="fa fa-arrow-left"></i></a>    
    Edit</h5>
    <div class="card">
        <div class="card-body">
        <form action="{{url('admin/tweet/'.$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Tweet</label>
                <textarea name="tweet"  class="form-control">{{$data->tweet}}</textarea>
            </div>
            <div class="form-group">
                <label for="">Img</label>
                <input type="file" class="form-control" name="img" >
            </div>
            <button class="btn btn-primary">Simpan</button>
        </form>
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush