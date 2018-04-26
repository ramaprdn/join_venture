@foreach($friends as $friend)
	<div class="row m-2">
		<div style="background-color: #cfcfcf; border-radius: 25px; width: 80; height: 80;"></div>
		<div class="ml-2 col-md-8">
			<b>{{ $friend->first_name ." ". $friend->last_name }}</b>
			<p>"journey is now"</p>
		</div>
		<div class="col-md-2">
			<input type="button" id="follow{{ $friend->id }}" class="btn buttonRounded btn-sm pull-right" onclick="follow({{ $friend->id }})" value="Follow"></input>
		</div>
	</div>
@endforeach