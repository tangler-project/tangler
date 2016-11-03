@if(count($errors))
	<div class="loginErrors">
		@foreach($errors->all() as $error)
			<p>{{$error}}</p>
		@endforeach	
	</div>
@endif

