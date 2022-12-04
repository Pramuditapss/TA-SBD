@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Database console</h2>
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
            <th>Nama console</th>
            <th>storage</th>
            <th>toko</th>
        </tr>
        @foreach ($joins as $join)
        <tr>
            <td>{{ $join->nama_console }}</td>
            <td>{{ $join->nama_storage }}</td>
            <td>{{ $join->nama_toko}} </td>
        </tr>
        @endforeach
    </table>
    {!! $joins->links() !!}
@endsection