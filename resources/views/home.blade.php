@extends('layouts.master')

@section('content')
    @include('partials.users.navbar-user')
    @include('partials.users.change-knot')
    @include('partials.users.media')
    @include('partials.users.public-knot-users')
@stop

@section('scripts')
	@include('partials.users.home-script')
@stop