@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>consoles</h2>
            </div>
            <div class="pull-right">
                @can('console-create')
                <a class="btn btn-success" href="{{ route('consoles.create') }}"> Create New console</a>
                @endcan
                @can('console-delete')
                <a class="btn btn-info" href="consoles/trash"> Deleted console</a>
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
            <th>ID console</th>
            <th>Nama console</th>
            <th>ID storage</th>
            <th>ID toko</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($consoles as $console)
        <tr>
            <td>{{ $console->id_console }}</td>
            <td>{{ $console->nama_console }}</td>
            <td>{{ $console->id_storage }}</td>
            <td>{{ $console->id_toko }}</td>
            <td>
                <form action="{{ route('consoles.destroy',$console->id_console) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('consoles.show',$console->id_console) }}">Show</a>
                    @can('console-edit')
                    <a class="btn btn-primary" href="{{ route('consoles.edit',$console->id_console) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('console-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $consoles->links() !!}
    
@endsection

