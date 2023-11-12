@extends('template.master_admin')
@push('css')
@endpush
@section('content')
<div class="container mt-2">
    <h5 class="title">
    <a href="{{url('admin/comments')}}"><i class="fa fa-arrow-left"></i></a>    
    Edit</h5>
    <div class="card">
        <div class="card-body">
        <form action="{{url('admin/comments/'.$data->id)}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Komentar</label>
                <textarea name="comment"  class="form-control">{{$data->comment}}</textarea>
            </div>
            <button class="btn btn-primary">Simpan</button>
        </form>
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush