@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted Storages</h2>
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
            <th>ID Storage</th>
            <th>Nama Storage</th>
            <th>Detail</th>
    
            <th width="280px">Action</th>
        </tr>
        @foreach ($storages as $storage)
        <tr>
            <td>{{ $storage->id_storage }}</td>
            <td>{{ $storage->nama_storage }}</td>
            <td>{{ $storage->detail }}</td>
          
            <td>
                    <a class="btn btn-info" href="trash/{{ $storage->id_storage }}/restore">Restore</a>
                    <a class="btn btn-danger" href="trash/{{ $storage->id_storage }}/forcedelete">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $storages->links() !!}
@endsection