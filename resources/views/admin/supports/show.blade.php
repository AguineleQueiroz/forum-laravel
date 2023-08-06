@extends('layouts/base')
@section('title') Support {{$support->id}}@endsection
@section('content')
    <h1>Doubt: {{ $support->subject }}</h1>
    <h5>Status: {{ $support->status }}</h5>
    <div>
        <p>{{ $support->content }}</p>
    </div>
@endsection