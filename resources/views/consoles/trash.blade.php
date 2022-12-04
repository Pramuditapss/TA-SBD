@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted consoles</h2>
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
                    <a class="btn btn-info" href="trash/{{ $console->id_console }}/restore">Restore</a>
                    <a class="btn btn-danger" href="trash/{{ $console->id_console }}/forcedelete">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $consoles->links() !!}
    
@endsection