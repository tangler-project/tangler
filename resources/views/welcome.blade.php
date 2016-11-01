@extends('layouts.master')

@section('content')
	<div id="welcome-body">
		<welcome></welcome>
	</div>
	<template id="welcome-template">
		    @include('partials.guests.navbar-guest')
		    @include('partials.guests.public-knots')
		    @include('partials.guests.discover')
		    @include('partials.guests.about-us')
	</template>

@stop

@section('scripts')
	@include('scripts.public-knots-script')
@stop
