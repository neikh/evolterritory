@extends('layouts.app')

@section('content')

    {!! json_encode($picture) !!}

<div id = "index">
    <index></index>
</div>
@endsection
