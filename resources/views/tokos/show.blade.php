@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Toko</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tokos.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Toko:</strong>
                {{ $toko->id_toko }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Toko:</strong>
                {{ $toko->nama_toko }}
            </div>
        </div>
        
    </div>
@endsection