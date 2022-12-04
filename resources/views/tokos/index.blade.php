@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Toko</h2>
            </div>
            <div class="pull-right">
                @can('toko-create')
                <a class="btn btn-success" href="{{ route('tokos.create') }}"> Create New Toko</a>
                @endcan
                @can('toko-delete')
                <a class="btn btn-info" href="tokos/trash"> Deleted Toko</a>
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
            <th>ID toko</th>
            <th>Nama toko</th>
        
            <th width="280px">Action</th>
        </tr>
        @foreach ($tokos as $toko)
        <tr>
            <td>{{ $toko->id_toko }}</td>
            <td>{{ $toko->nama_toko }}</td>
            <td>
                <form action="{{ route('tokos.destroy',$toko->id_toko) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('tokos.show',$toko->id_toko) }}">Show</a>
                    @can('toko-edit')
                    <a class="btn btn-primary" href="{{ route('tokos.edit',$toko->id_toko) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('toko-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $tokos->links() !!}
    
@endsection


