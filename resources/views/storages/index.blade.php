@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Storage</h2>
            </div>
            <div class="pull-right">
                @can('storage-create')
                <a class="btn btn-success" href="{{ route('storages.create') }}"> Create New Storage</a>
                @endcan
                @can('storage-delete')
                <a class="btn btn-info" href="storages/trash"> Deleted Storage</a>
                @endcan
            </div>
            <div class="my-3 col-12 col-sm-8 col-md-5">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Keyword" name = "keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                        <button class="input-group-text btn btn-primary" id="basic-addon1">Search</button>
                    </div>
                </form>
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
                <form action="{{ route('storages.destroy',$storage->id_storage) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('storages.show',$storage->id_storage) }}">Show</a>
                    @can('storage-edit')
                    <a class="btn btn-primary" href="{{ route('storages.edit',$storage->id_storage) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('storage-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $storages->links() !!}
   
@endsection

