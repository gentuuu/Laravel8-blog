@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('breadcrumbs')
    breadcrumbs
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            Content {{ Auth::user()-> name }}
        </div>
    </div>
@endsection
