@php
	$time = new App\Http\Controllers\TimeForHumans;	
@endphp

@foreach($comments as $comment)
	<div class="col-sm-1">
		<div style="height: 40px; width: 40px; border-radius: 30px; background-color: #ccc">
		</div>
	</div>
	<div class="col-sm-11">
		<p style="margin-bottom: 0px;"><b>{{ $comment->user->first_name.' '.$comment->user->last_name }}</b><span> {{ $comment->comment }}</span></p>
		<p style="font-size: 10px; color: #ccc">{{ $time->time_elapsed_string($comment->created_at) }}</p> 
	</div>
@endforeach