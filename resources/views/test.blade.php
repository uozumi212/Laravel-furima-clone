@extends('layouts.app')
@section('content')
    <test-component
        :tests="{{$tests}}"
    ></test-component>
@endsection
