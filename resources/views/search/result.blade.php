@extends('layouts.app2')

@section('css')
<script type="text/javascript">
	function loadUnfollowed(q, search){
		var url = 'search/unfollowedFriend?q=' + q + '&search=' + search;
		$.ajax({
			type:'get',
			url:url,
			success:function(data){
				$('#unfollowed').html(data);
			}
		})
	}

	function loadfollowed(q, search){
		var url = 'search/followedFriend?q=' + q + '&search=' + search;
		$.ajax({
			type:'get',
			url:url,
			success:function(data){
				$('#followed').html(data);
			}
		})
	}
</script>
@endsection

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
					Orang yang anda tidak ikuti
					<div id="unfollowed">
						<script type="text/javascript" async>
							loadUnfollowed('{{ $query }}', '{{ $search_string }}');
						</script>	
					</div>
					
					Orang yang anda ikuti
					<div id="followed">
						<script type="text/javascript" async>
							loadfollowed('{{ $query }}', '{{ $search_string }}');
						</script>	
					</div>
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
					loadUnfollowed('{{ $query }}', '{{ $search_string }}');
					loadfollowed('{{ $query }}', '{{ $search_string }}');
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
					loadfollowed('{{ $query }}', '{{ $search_string }}');
					loadUnfollowed('{{ $query }}', '{{ $search_string }}');
				},
				error: function(){
					alert('error while trying to unfollow');
				}

			})	
		}
	</script>
@endsection