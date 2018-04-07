@extends('layouts.app2')

@section('section')
<div class="container" style="margin-top: 80px;">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					Filter
				</div>
				<div class="card-body">
					
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					People
				</div>
				<div class="card-body">
					@foreach($users as $user)
						<div class="row m-2">
							<div style="background-color: #cfcfcf; border-radius: 25px; width: 80; height: 80;"></div>
							<div class="ml-2 col-md-8">
								<b>{{ $user->first_name ." ". $user->last_name }}</b>
								<p>"journey is now"</p>
							</div>
							<div class="col-md-2">
								<input type="button" id="follow{{ $user->id }}" class="btn btn-info btn-sm pull-right" onclick="follow({{ $user->id }})" value="Follow"></type>
							</div>
						</div>
						<hr>
					@endforeach
				</div>
			</div>
		</div>	
		</div>
</div>
@endsection

@section('script')
	<script type="text/javascript">
		function follow(id){
			var url = '/follow/' + id;
			var unfollow = 'unfollow('+id+')';
			$.ajax({
				type:'get',
				url:url,
				success:function(){
					$('#follow'+id).attr('value', 'Unfollow');
					$('#follow'+id).attr('onclick', unfollow);
				},
				error: function(){
					alert('error while trying to following');
				}

			})
		}

		function unfollow(id){
			var url = '/unfollow/' + id;
			var follow = 'follow('+id+')';
			$.ajax({
				type:'get',
				url:url,
				success:function(){
					$('#follow'+id).attr('value', 'Follow');
					$('#follow'+id).attr('onclick', follow);
				},
				error: function(){
					alert('error while trying to unfollow');
				}

			})	
		}
	</script>
@endsection