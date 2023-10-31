@extends('template.master_admin')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="container mt-2">
    <div class="card">
        <div class="card-body">
            <h5>Tweets</h5>


            <table class="table table-striped" id="example">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Comment on</th>
                        <th scope="col">Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $n=>$t)
                        <tr>
                            <td>{{$n+1}}</td>
                            <td>{{'@'.$t->from}}</td>
                            <td>{{'@'.$t->to}}</td>
                            <td>
                              {{$t->comment}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


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