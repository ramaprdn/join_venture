{{--  --}}
@foreach($adventures as $adventure)
	<div class="col-md-4 mb-3">
		<div class="card card-rounded">
	        <img style="position: relative;" class="image-home" src="{{asset('img/adventure/'.$adventure->image)}}" id="background-image"> 
	        
	        <div class="card-body">
	            <div class="green-text">
	                <h5><b><center id="adventure_name">{{ $adventure->name }}</center></b></h5>
	                <center>Destinasi:</center>
	            </div>
	            <div class="row">
	            	<div class="" style="margin: 0 auto; height: 50px; overflow: hidden;" id="destination-preview">
	            		@foreach($adventure->destination as $dest)
	            			<span class='badge badge-pill badge-success mr-1 mt-1' id='destination_item_span"+ destination_count +"'>{{ $dest->destinations }}</span>
	            		@endforeach
	                </div>
	            </div>
	            <div class="mt-5">
	            	<a href="/adventure/{{ $adventure->id }}" class="pull-right">more info</a>
	            </div>
	        </div>
	    </div>
	</div>
@endforeach
{{--  --}}