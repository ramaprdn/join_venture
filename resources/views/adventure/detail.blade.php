@extends('layouts.app2')
@section('title')
	{{$adventure->name}}
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fancybox.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/line-awesome.min.css') }}">
<style type="text/css">
	.card-body{
		padding: 0px;
	}

	.fa{
	    font-size:20px;
	}
	.card-image-header{
		width: 100%;
		height: 220px;
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
	}

	.card{
		margin-bottom: 8px;
	}
	
	.card-description{
		width: 100%;
		padding: 24px;
		padding-top: 8px;
	}

	#map {
		height: 200px;
	}

	.desc-adventure{
		padding: 24px;
		padding-top: 8px;
		padding-bottom: 0px;
		overflow: hidden;
		max-height: 50px;
	}

	.desc-adventure-hide{
		padding: 24px;
		padding-top: 8px;
		padding-bottom: 0px;
	}
</style>
<script type="text/javascript">
	
	function load_comment(id, disc_id){
		var url = "/adventure/"+id+"/discussions/"+disc_id+"/load-comment";
		$.ajax({
			type:'get',
			url:url,
			success:function(data){
				$('#comments'+disc_id).html(data);
			}
		})
	}
</script>
@endsection

@section('section')
<div class="container" style="margin-top: 80px; max-width: 900px;">
	<div class="accordion" id="accordion">
		<div class="card">
			<div class="card-body" id="headingOne">
				<div class="card-image-header" style="background-image: url('{{ asset("/img/adventure/".$adventure->image) }}')">
				</div>
				<center><h5 class="color-title" style="font-weight: bold; margin-top: 20px;">{{ $adventure->name }}</h5></center>
				
				<div class="desc-adventure" id="desc-adventure">
					<center><p class="color-text" style="margin-bottom: 0px;">Deskripsi</p></center>
					<div style="margin-bottom: 0px; margin: 0 auto; text-align: center;">
						<p class="color-text">{{ $adventure->description }}</p>					
					</div>	
				</div>
				
				<div id="description" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="card-description">
						
						<center><p class="color-text" style="margin-bottom: 0px;">Destinasi</p></center>
						<div class="row" style="margin-bottom: 8px;">
							<div style="max-width: 500px; margin: 0 auto; text-align: center;">
								@foreach($adventure->destination as $dest)
									<span class="badge badge-pill badge-success">{{ $dest->destinations }}</span>
								@endforeach
							</div>
						</div>

						<div id="map"></div>
					</div>
				</div>
			</div>
			<div style="padding: 16px;">
				@if($adventure->user_id != Auth::user()->id)
				<a href="{{route('adventure.join', $adventure->id)}}" class="btn btn-info"><span class="la {{($user_status_to_adventure != null && $user_status_to_adventure->status == 1) ? 'la-sign-out' : 'la-sign-in'}}"></span>{{($user_status_to_adventure != null && $user_status_to_adventure->status == 1) ? 'Keluar' : 'Join'}}</a>
				@endif
				<a href="" id="btn-desc" class="btn btn-info" data-toggle="collapse" data-target="#description" aria-expanded="true" aria-controls="description" onclick="toggle_description()">lebih banyak</a>
				<a href="" class="pull-right" data-toggle="modal" data-target="#exampleModal">{{ $partisipants_count }} orang ikut di petualangan ini</a>	
			</div>
			
		</div>
	</div>

	<form action="{{ route('discussion.store', $adventure->id) }}" method="post">
		@csrf
		<div class="card">
			<div class="card-description" style="margin-top: 16px;">
				<div class="row" id="">
		    		<div class="col-sm-11">
		    			<input id="" type="text" name="topic" class="form-control" placeholder="tanyakan keperluan anda disini.." required>
		    		</div>
		    		<div class="col-sm-1">
		    			<button type="submit" style="background-color: transparent; border-style: none;">
		    				<span class="la la-paper-plane color-title pull-right" style="font-size: 35px; cursor: pointer;"></span>
		    			</button>
		    		</div>
		        </div>
			</div>
		</div>
	</form>

	@foreach($discussions as $discussion)
		<div class="card">
	        <div class="card-body" style="padding: 16px;">
            {{-- post --}}
            <h5 class="green-text" style="font-weight: bold; margin-bottom: 0px;">{{$discussion->user->first_name.' '.$discussion->user->last_name}}</h5>
            @php
                $time = new App\Http\Controllers\TimeForHumans; 
            @endphp
            <p style="margin-top: 0; font-size: 11px;" class="color-text-o"><p>
            <div style="font-size: 14px;" class="color-text">
                {{ $discussion->topic }} 
            </div>

            {{-- comment icon --}}
            <div style="margin-top: 30px;" class="action-icon">
                <span class="color-text fa fa-comment-o" id="comment-icon" onclick="toggle_comment({{ $discussion->id}})" style="cursor: pointer;"></span>
            </div>
	        </div>
	        <div class="card-footer bg-light">
	            <div class="row" id="toggle-comment{{ $discussion->id}}" style="display: none;">
	        		<div class="col-sm-11">
	        			<input id="comment{{ $discussion->id }}" type="text" class="form-control" placeholder="komentar disini.." style="border-style: none;">
	        		</div>
	        		<div class="col-sm-1">
	              <span class="la la-paper-plane color-text pull-right" style="font-size: 35px; cursor: pointer;" onclick="sendComment({{$discussion->id}})"></span>
	        		</div>
	            </div>

	          	<div class="row col-sm-12" style="padding-top: 20px;" id="comments{{ $discussion->id }}">
	          		
	          	</div>
	          	<script type="text/javascript">
                  window.setInterval(function(){
                      load_comment({{ $adventure->id }}, {{ $discussion->id }})
                  }, 5000);
              </script>  
	        </div>
	    </div>
    @endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pengikut {{$adventure->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height: 480px; overflow-y: scroll;">
		@foreach($partisipants as $partisipant)
			<div class="row">
				<div class="col-sm-2">
					<div style="height: 50px; width: 50px; border-radius: 30px; background-color: #ccc; margin-right: 4px;">
					</div>
				</div>
				<div class="col-sm-10">
					<p style="margin-bottom: 0px;"><b>{{ $partisipant->user->first_name.' '.$partisipant->user->last_name }}</b><span style="font-size: 10px; color: #ccc"></p>
					<p>Live like Larry</p> 
				</div>
			</div>
		@endforeach        
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
	function initMap() {
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: {{ $adventure->destination[0]->lat }}, lng: {{ $adventure->destination[0]->long }}},
			zoom: 8
		});

		setMarkers(map);
	}

	var beaches = [
	@foreach ($adventure->destination as $key => $dest)
		['{{ $dest->destinations }}', {{ $dest->lat }}, {{ $dest->long }}, {{ $key }}],
	@endforeach
	  
	];

	function setMarkers(map) {
	  // Adds markers to the map.

	  // Marker sizes are expressed as a Size of X,Y where the origin of the image
	  // (0,0) is located in the top left of the image.

	  // Origins, anchor positions and coordinates of the marker increase in the X
	  // direction to the right and in the Y direction down.
	  
	  // Shapes define the clickable region of the icon. The type defines an HTML
	  // <area> element 'poly' which traces out a polygon as a series of X,Y points.
	  // The final coordinate closes the poly by connecting to the first coordinate.
	  
	  for (var i = 0; i < beaches.length; i++) {
	    var beach = beaches[i];
	    var marker = new google.maps.Marker({
	      position: {lat: beach[1], lng: beach[2]},
	      map: map,
	      title: beach[0],
	      zIndex: beach[3]
	    });
	  }
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuzok_jxa1DYFbm0C8xlmt3y4pZW92v9w&libraries=places&callback=initMap"
        async defer></script>
<script type="text/javascript" src="{{ asset('/js/general.js') }}" async defer></script>

<script type="text/javascript" async>
	function toggle_description(){
		
		if($('#btn-desc').text() == 'lebih banyak'){
			$('#btn-desc').html('sembunyikan');
		}else{
			$('#btn-desc').html('lebih banyak');
		}
	}

	$('#btn-desc').click(function(){
		var clas = $('#desc-adventure').attr('class');
		if(clas == 'desc-adventure'){
			$('#desc-adventure').attr('class', 'desc-adventure-hide');
		}else{
			$('#desc-adventure').attr('class', 'desc-adventure');
		}
	})

	function get_partisipants(id){
		var url = '';
		$.ajax({
			type:'get',
			url: url,
			success: function(){

			},
			error: function(){

			}
		})
	}

	function sendComment(id){
		var url = "/adventure/"+id+"/discussions/send-comment";
		var token = "{{csrf_token()}}";
		var user_login = {{Auth::user()->id}};
		var message = $('#comment'+id).val();
		

		$.post(url, {
			message: message,
			_token: token,
			user_id: user_login,
			id: id
		}, function(data){
			load_comment({{$adventure->id}}, id);
			$('#comment'+id).val('');
		})
	}
</script>
@endsection