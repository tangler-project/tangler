@if(count($errors))
	<div class="errors">
		@foreach($errors->all() as $error)
			<p>{{$error}}</p>
		@endforeach	
	</div>
@endif

