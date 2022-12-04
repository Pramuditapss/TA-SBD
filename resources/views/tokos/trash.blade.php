@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted Tokos</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID toko</th>
            <th>Nama toko</th>
    
            <th width="280px">Action</th>
        </tr>
        @foreach ($tokos as $toko)
        <tr>
            <td>{{ $toko->id_toko }}</td>
            <td>{{ $toko->nama_toko }}</td>
          
            <td>
                    <a class="btn btn-info" href="trash/{{ $toko->id_toko }}/restore">Restore</a>
                    <a class="btn btn-danger" href="trash/{{ $toko->id_toko }}/forcedelete">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $tokos->links() !!}
@endsection