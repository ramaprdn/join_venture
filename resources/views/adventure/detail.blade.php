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

	.card-image-header{
		width: 100%;
		height: 220px;
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
	}
	
	.card-description{
		width: 100%;
		padding: 24px;
	}

	#map {
		height: 200px;
	}
</style>
@endsection

@section('section')
<div class="container" style="margin-top: 80px; max-width: 900px;">
	<div class="accordion" id="accordion">
		<div class="card">
			<div class="card-body" id="headingOne">
				<div class="card-image-header" style="background-image: url('{{ asset("/img/adventure/".$adventure->image) }}')">
				</div>
				<center><h5 class="color-title" style="font-weight: bold; margin-top: 20px;">{{ $adventure->name }}</h5></center>
			

				<div id="description" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="card-description">

						<center><p class="color-text" style="margin-bottom: 0px;">Destinasi</p></center>
						<div class="row">
							<div style="max-width: 500px; margin: 0 auto; text-align: center;">
								@foreach($adventure->destination as $dest)
									<span class="badge badge-pill badge-success">{{ $dest->destinations }}</span>
								@endforeach
							</div>
						</div>

						<center><p class="color-text" style="margin-bottom: 0px; margin-top: 16px;">Deskripsi</p></center>
						<div style="max-width: 500px; margin: 0 auto; text-align: center;">
							<p class="color-text">{{ $adventure->description }}</p>					
						</div>

						<div id="map"></div>
					</div>
				</div>
			</div>
			<div style="padding: 16px;">
				<a href="" class="btn btn-info"><span class="la la-sign-in"></span> Join</a>
				<a href="" id="btn-desc" class="btn btn-info" data-toggle="collapse" data-target="#description" aria-expanded="true" aria-controls="description" onclick="toggle_description()">lebih banyak</a>	
			</div>
			
		</div>
	</div>

	<div class="card" style="margin-top: 8px;">
		<div class="card-description">
			<div class="row" id="">
        		<div class="col-sm-11">
        			<input id="" type="text" name="comment" class="form-control" placeholder="tanyakan keperluan anda disini..">
        		</div>
        		<div class="col-sm-1">
                    <span class="la la-paper-plane color-title pull-right" style="font-size: 35px; cursor: pointer;"></span>
        		</div>
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

<script type="text/javascript">
	function toggle_description(){
		
		if($('#btn-desc').text() == 'lebih banyak'){
			$('#btn-desc').html('sembunyikan');
		}else{
			$('#btn-desc').html('lebih banyak');
		}
	}
</script>
@endsection