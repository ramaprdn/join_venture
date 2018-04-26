@extends('layouts.app2')

@section('title')
Pencarian
@endsection

@section('css')

<style type="text/css">
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #584747;
    background-color: #f7f7f7;
}
.image-home {
    max-height: 110px;
    border-top-right-radius: 15px;
    border-top-left-radius: 15px;
    object-fit: cover;
}

a{
	color: #629474;
}

a:hover{
	color: #000;
}

input[type="button"]{
	color: #FFFFFF;
    background-color: #549886;
}
</style>

<script type="text/javascript">
	function loadUnfollowed(q, search){
		var url = 'search/unfollowedFriend?q=' + q + '&search=' + search;
		var message = "<p class='color-text-o'>tidak ditemukan...</p>";
		$.ajax({
			type:'get',
			url:url,
			success:function(data){
				if(data != ''){
					$('#unfollowed').html(data);
				}else{
					$('#unfollowed').html(message);
				}
			}
		})
	}

	function loadfollowed(q, search){
		var url = 'search/followedFriend?q=' + q + '&search=' + search;
		var message = "<p class='color-text-o'>tidak ditemukan...</p>";
		$.ajax({
			type:'get',
			url:url,
			success:function(data){
				if(data != ''){
					$('#followed').html(data);
				}else{
					$('#followed').html(message);
				}
			}
		})
	}

	function adventure(q, search){
		var url = 'search/adventure?q=' + q + '&search=' + search;
		var message = "<p class='color-text-o'>tidak ditemukan petualangan yang sesuai...</p>";
		$.ajax({
			type:'get',
			url:url,
			success:function(data){
				if(data != ''){
					$('#adventure-list').html(data);
				}else{
					$('#adventure-list').html(message);
				}
			}
		})
	}
</script>
@endsection

@section('section')
<div class="container" style="margin-top: 80px;">
	<div class="row">
		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					<p class="color-title" style="font-weight: bold; margin-bottom: 0px;">Filter</p>
				</div>
				<div class="card-body">
					<div>
						<p class="color-title" style="font-weight: bold;">Orang</p>
						<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a class="nav-link active" id="v-pills-unfollowed-tab" data-toggle="pill" href="#v-pills-unfollowed" role="tab" aria-controls="v-pills-unfollowed" aria-selected="true">Tidak Diikuti</a>
							<a class="nav-link" id="v-pills-followed-tab" data-toggle="pill" href="#v-pills-followed" role="tab" aria-controls="v-pills-followed" aria-selected="false">Diikuti</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-body">
					{{-- nav result --}}
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active color-title show" id="nav-people-tab" data-toggle="tab" href="#nav-people" role="tab" aria-controls="nav-people" aria-selected="true">Orang</a>
							<a class="nav-item nav-link color-title" id="nav-adventure-tab" data-toggle="tab" href="#nav-adventure" role="tab" aria-controls="nav-adventure" aria-selected="false">Petualangan</a>
						</div>
					</nav>
					{{-- nav result --}}

					{{-- content result --}}
					<div class="tab-content" id="nav-tabContent" style="margin-top: 10px;">
						<div class="tab-pane fade show active" id="nav-people" role="tabpanel" aria-labelledby="nav-people-tab">
							<div class="col-sm-12">
								<div class="tab-content" id="v-pills-tabContent">
									<div class="tab-pane fade" id="v-pills-followed" role="tabpanel" aria-labelledby="v-pills-hofollowedme-tab">
										<div id="followed">
											<script type="text/javascript" async>
												loadfollowed('{{ $query }}', '{{ $search_string }}');
											</script>	
										</div>
									</div>
									<div class="tab-pane fade show active" id="v-pills-unfollowed" role="tabpanel" aria-labelledby="v-pills-unfollowed-tab">
										<div id="unfollowed">
											<script type="text/javascript" async>
												loadUnfollowed('{{ $query }}', '{{ $search_string }}');
											</script>	
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="tab-pane fade" id="nav-adventure" role="tabpanel" aria-labelledby="nav-adventure-tab">
							<div class="row" id="adventure-list">
								<script type="text/javascript">
									adventure('{{ $query }}', '{{ $search_string }}');
								</script>
							</div>
						</div>
					</div>
					{{-- content result --}}	
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