@extends('layouts.master')

@section('content')
	<div id="home-body">
		<home></home>
	</div>
	<template id="home-template">
	    @include('partials.users.navbar-user')
	    @include('partials.users.change-knot')
	    @include('partials.users.media')
	</template>
@stop

@section('scripts')
	@include('scripts.user-knots-script')
@stop