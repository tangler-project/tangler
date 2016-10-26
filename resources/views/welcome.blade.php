@extends('layouts.master')

@section('content')
    @include('partials.guests.navbar-guest')
    @include('partials.guests.landing')
    @include('partials.guests.discover')
    @include('partials.guests.about-us')
    @include('partials.guests.public-knot-guest')
@stop

@section('scripts')
	@include('scripts.public-knots-script')
@stop
