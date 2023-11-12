@extends('template.master_admin')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="container mt-2">
    <div class="card">
        <div class="card-body">
            <h5>Tweets</h5>


            <div class="table-responsive">
            <table class="table table-striped" id="example">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Bio</th>
                        <th scope="col">Location</th>
                        <th scope="col">Website</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $n=>$t)
                        <tr>
                            <td>{{$n+1}}</td>
                            <td>{{$t->name}}</td>
                            <td>{{'@'.$t->username}}</td>
                            <td>{{$t->email}}</td>

                            <td>
                                <img src="{{url('public/image/profil/'.$t->foto)}}" alt="" srcset="" width="35px" height="35px"  class="rounded-circle">
                            </td>
                            <td>{{$t->bio}}</td>
                            <td>{{$t->location}}</td>
                            <td>{{$t->website}}</td>

                            <td>
                            <a href="{{url('admin/user/'.$t->id)}}" class="btn btn-sm btn-warning mb-1"><i class="fa fa-edit"></i></a>
                            <a href="{{url('admin/userdelete/'.$t->id)}}" class="btn btn-sm btn-danger mb-1"><i class="fa fa-trash"></i></a >
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>


        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
    new DataTable('#example');
</script>
@endpush