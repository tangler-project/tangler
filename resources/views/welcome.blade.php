@extends('layouts.master')

@section('content')
    @include('auth.navbar-guest')
    @include('partials.guests.landing')
    @include('partials.guests.discover')
    @include('partials.guests.about-us')
    @include('partials.guests.public-knot-guest')
@stop
