@extends('layouts.app2')

@section('title')
JoinVenture - Home
@endsection

@section('css')
<link href="{{ asset('dist/emojionearea.css') }}" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fancybox.min.css') }}">

<style type="text/css">
	.img-preview{
		max-height: 100px;
		margin-right: 2px; 
	}

	.image_emoticon > img{
		max-height: 18px;
	}

	.imagelist > a > img{
		max-height: 100px;	
	}
</style>
<script type="text/javascript">
	function getPostImage(post_id){
		var url = '/post/image/' + post_id;
		var div_class = 'imagelist' + post_id;
		$.ajax({
			type:'get',
			url:url,
			success:function(data){
				$('#' + div_class).html(data);
			},
			error: function(){
				alert('gagal');
			}
		})
	}
</script>
@endsection

@section('section')
<div class="container-fluid" style="margin-top: 80px;">
    <div class="row">   
        <div class="col-lg-3 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><b>Nearby Adventure</b></h5>
                    <br>
                    <img src="nearby-1.jpg" alt="..." class="rounded imgThumb">    
                    <img src="nearby-2.jpg" alt="..." class="rounded imgThumb">
                    <img src="nearby-1.jpg" alt="..." class="rounded imgThumb">             
                    <img src="nearby-2.jpg" alt="..." class="rounded imgThumb">
                    <img src="nearby-1.jpg" alt="..." class="rounded imgThumb">
                    <img src="plus.png" alt="..." class="rounded imgThumb">
                </div>
            </div>
        </div>
    
        
        <div class="col-lg-6 col-sm-12">
            <div class="card">
            	<form action="/post/image" method="POST" enctype="multipart/form-data" onsubmit="insert_post()">
	        		@csrf
	        		<div class="card-body">
	                    <div class="row">
	                        <div class="col-lg-2">
	                            <div style="height: 70px; width: 70px; border-radius: 50px; background-color: #000"></div>                                
	                        </div>
	                        <div class="form-group col-lg-10">
	                            <textarea class="form-control bg-light" name="test" id="post" rows="4" placeholder="Where have you been, {{Auth::user()->first_name}}?" required></textarea>
	                        </div>
	                         
	                    </div>
	                    <input type="file" name="image_post[]" id="image-input" multiple="" accept="image/*">
	                    <div id="previewImage"></div>
	                </div>
	                <div class="card-footer">
	                    <div class="col-sm-12">
	                        <button type="button" class="btn btn-info buttonRounded" onclick="addImage()">Add Photo</button>
	                        <button type="submit" class="btn btn-success buttonRounded pull-right" >PUSH</button>
	                    </div>
	                </div>
            	</form>               
            </div>
            <br>

            @foreach($user_friend_post as $post)
            	<div class="card">
	                <div class="card-body">
	                    <h5 class="card-title">{{ $post->first_name." ".$post->last_name}}</h5>
	                    @php
	                    	$time = new App\Http\Controllers\TimeForHumans;	
	                    @endphp
	                    {{ $time->time_elapsed_string($post->created_at) }}
	                    <div class="image_emoticon">
	                    	{!! $post->description !!}	
	                    </div>
	                    <script type="text/javascript">
	                    	getPostImage({{ $post->id }});
	                    </script>
	                    <div class="imagelist" id="imagelist{{ $post->id }}">
	                    	
	                    </div>
	                </div>
	                <div class="card-footer">
	                    <small class="text-muted">Last updated 3 mins ago</small>
	                </div>
	            </div>
            @endforeach()
            
        </div>
       
        <div class="col-lg-3 col-sm-12">                
            <div class="card">
                <div class="card-body">
                    <h5><b>Story</b></h5>
                    <br>
                    <img src="nearby-1.jpg" alt="..." class="rounded-circle imgThumb">    
                    <img src="nearby-2.jpg" alt="..." class="rounded-circle imgThumb">
                    <img src="nearby-1.jpg" alt="..." class="rounded-circle imgThumb">             
                    <img src="nearby-2.jpg" alt="..." class="rounded-circle imgThumb">
                    <img src="nearby-1.jpg" alt="..." class="rounded-circle imgThumb">
                    <img src="plus.png" alt="..." class="rounded-circle imgThumb">
                </div>
            </div>             
        </div>
    </div>
</div>
	
</script>
@endsection

@section('script')
<script src="{{ asset('dist/emojionearea.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript">


	$(document).ready(function(){
		$('#post').emojioneArea({
            pickerPosition: "bottom"
        });
	});

	function insert_post(){
		var description = $('.emojionearea-editor').html();
		var _token = $("input[name=_token]").val();
		var http = new XMLHttpRequest();
		var url = "/post";
		var params = "description=" + description + "&_token=" + _token;
		http.open("POST", url, true);

		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		http.send(params);
	}

	function previewImage(input){
		if(input){
			var i = 0;
			for(i ; i < input.files.length; i++){
				var reader = new FileReader();

				reader.onload = function(e){
					var image = "<img class='img-preview' src='"+ e.target.result +"' alt='your image' />";
					$('#previewImage').append(image);
				}

				reader.readAsDataURL(input.files[i]);
			}
		}
	}

	$("#image-input").change(function() {
		$('#previewImage').html('');
		previewImage(this);
	});

	
</script>
@endsection