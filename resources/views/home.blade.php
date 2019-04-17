@extends('layouts.app')

@section('content')

{{$picture}}
<div id = "index">
    <index v-bind:randomPic="'bobobo'"></index>
</div>
@endsection
