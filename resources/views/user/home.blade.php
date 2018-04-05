@extends('layouts.app2')

@section('title')
JoinVenture - Home
@endsection

@section('css')
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
	/*style tambahan*/
	.green-text {
        color: #549886;
    }
    .grey-text {
        color: #959595;
    }
    button {
        color: #FFFFFF;
        background-color: #549886;
    }
    button:hover {
        opacity: 0.6 !important;
        transition: 0.5s;
    }
    .buttonRounded {
        border-radius: 30px;
    }

    .card-rounded {
        border-radius: 15px;
    }
    .card-timeline-title {
        border-top-left-radius: 0px;
        border-top-right-radius: 25px;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 25px;
        margin-top: 120px;
    }
    .image-home {
        max-height: 110px;
        border-top-right-radius: 15px;
        border-top-left-radius: 15px;
        object-fit: cover;
    }
    .image-profile {
        max-width: 80px; 
        margin-top: 70px;
        margin-left: 15px; 
        border: 2px solid;
        border-color: #FFFFFF;
        object-fit: cover;
    }
    .image-timeline {
        max-height: 300px;
        border-top-right-radius: 15px;
        border-top-left-radius: 15px;
        object-fit: cover;
        opacity: 0.5;
    }
    .image-story {
        width: 60px;
        height: 60px;
        display: inline-block;
        cursor: pointer;
    }
    .image-story:hover {
        opacity: 0.6;
        transition: 0.5s;
    }
    .image-arrow {
        width: 20px;
        opacity: 0.6;
        display: block;
        margin: 0 auto;
        cursor: pointer;
    }
    .image-arrow:hover {
        opacity: 0.2;
        transition: 0.4s;
    }
    .image-upload > input {
    	display: none;
    }
    .image-upload > label:hover{
        opacity: 0.5;
        transition: 0.5s;
    }
    .vertical-scroll-wrapper {
        width: 100%;
        height: 180px;
        overflow-y: auto;
        overflow-x: hidden;         
    }
    #horizontal-scroll-wrapper {
        height:60px;
        background-color: #FFF;
        overflow-x: auto;
        overflow-y: hidden;
        border-radius: 50px;
        white-space: nowrap;
        scroll-behavior: smooth;
    }
    #horizontal-scroll-wrapper::-webkit-scrollbar {
        display: none;
    }

    @media (max-width: 575px) {
        .image-arrow {
            margin-left: -50px;
        }
    }
</style>
<script type="text/javascript" async>
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

	function loadComment(post_id){
		var url = 'api/comment/' + post_id;

		$.ajax({
			type:'get',
			url:url,
			success: function(data){
				$('#comments'+post_id).html(data);
			},
			error: function(){
				alert("error collecting comment");
			}
		});
	}
</script>
@endsection

@section('section')
<div class="container" style="margin-top: 80px;">
    <div class="row">   
        <div class="col-md-4 col-sm-12">
            <div class="card card-rounded">
                <img style="position: relative;" class="image-home" src="{{asset('img/nearby-1.jpg')}}"> 
                <div style="position: absolute;">
                    <img class="rounded-circle image-profile" src="{{asset('img/profile.jpg')}}">
                </div>
                <div class="card-body">
                    <div class="green-text">
                        <br>
                        <h5><b>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</b></h5>
                        <small>"Living Like Larry"</small>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn" style="border-radius: 50px;"><b>></b></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-rounded my-2">
                <div class="card-body">
                    <div class="green-text">
                        <h5><b>Top Stories</b></h5>
                        <br>
                        <div class="row">
                            <div class="col-md-1 col-sm-1 px-0 pt-4">
                                <img id="leftArrow" src="{{asset('img/left-arrow.png')}}" class="image-arrow">
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <div id="horizontal-scroll-wrapper">
                                    <img class="image-story rounded-circle" src="{{asset('img/nearby-1.jpg')}}">
                                    <img class="image-story rounded-circle" src="{{asset('img/nearby-2.jpg')}}">
                                    <img class="image-story rounded-circle" src="{{asset('img/nearby-1.jpg')}}">
                                    <img class="image-story rounded-circle" src="{{asset('img/nearby-2.jpg')}}">
                                    <img class="image-story rounded-circle" src="{{asset('img/nearby-1.jpg')}}">
                                    <img class="image-story rounded-circle" src="{{asset('img/nearby-2.jpg')}}">
                                    <img class="image-story rounded-circle" src="{{asset('img/nearby-1.jpg')}}">
                                    <img class="image-story rounded-circle" src="{{asset('img/nearby-2.jpg')}}">
                                    <img class="image-story rounded-circle" src="{{asset('img/nearby-1.jpg')}}">
                                    <img class="image-story rounded-circle" src="{{asset('img/nearby-2.jpg')}}">
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-1 px-0 pt-4">
                                <img id="rightArrow" src="{{asset('img/right-arrow.png')}}" class="image-arrow">
                            </div>
                            
                        </div>
                        
                        <br>
                        <h5><b>Nearby Adventure</b></h5>
                        <div class="vertical-scroll-wrapper">
                            <div><a href="#" class="green-text"><p>Denpasar</p></a></div>
                            <hr>
                            <div><p>Badung</p></div>
                            <hr>
                            <div><p>Gianyar</p></div>
                            <hr>
                            <div><p>Bangli</p></div>
                            <hr>
                            <div><p>Tabanan</p></div>
                            <hr>
                            <div><p>Karangasem</p></div>
                            <hr>
                            <div><p>Jembrana</p></div>
                            <hr>
                            <div><p>Klungkung</p></div>
                            <hr>
                            <div><p>Singaraja</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card card-rounded">
            	<form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
	        		@csrf
	        		<div class="card-body">
                        <div class="form-group">
                            <textarea class="form-control bg-light card-rounded" name="description" id="post" rows="6" placeholder="Where have you been, {{Auth::user()->first_name}}?" required></textarea>
                        </div>
	                    <div id="previewImage"></div>
	                </div>
                    <div class="col-sm-12">
                    	<div class="image-upload">
                    		<label for="image-input">
                    			<img class="mx-2" src="{{asset('img/choose-image.png')}}" style="max-width: 30px; opacity: 0.6; cursor: pointer;">
                    		</label>
                         	<input type="file" name="image_post[]" id="image-input" multiple="" accept="image/*">
                        	<button type="submit" class="btn buttonRounded pull-right px-md-4 px-sm-1 mx-2">PUSH</button>
                   		</div>
                    </div>
            	</form>               
            </div>
            <br>

            @foreach($user_friend_post as $post)
            	<div class="card mb-2 card-rounded">
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
	                    	loadComment({{ $post->id }});
	                    </script>
	                    <div class="imagelist" id="imagelist{{ $post->id }}">
	                    	
	                    </div>
	                    <a href="{{ route('like', $post->id) }}">like</a>
	                </div>
	                <div class="card-footer card-rounded">
	                    <div class="row">
                    		<div class="col-sm-10">
                    			<input id="comment{{ $post->id }}" type="text" name="comment" class="form-control" placeholder="comment">
                    		</div>
                    		<div class="col-sm-2">
                    			<button type="button" class="btn buttonRounded" onclick="sendComment({{ $post->id.",".Auth::user()->id }})">Send</button>
                    		</div>
	                    </div>

	                  	<div class="row col-sm-12 mt-4" id="comments{{ $post->id }}">
	                  		
	                  	</div>
	                </div>
	            </div>
            @endforeach()
            
        </div>
    </div>
</div>
	
</script>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript" async>


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

	function sendComment(post_id, user_id){
		var url = '/api/comment/store';
		var comment = $('#comment' + post_id).val();
		var params = "?comment=" + comment + "&post_id=" + post_id + "&user_id=" + user_id;
		var fullUrl = url + params;
		$('#comment' + post_id).val('');
		$.ajax({
			type:'get',
			url:fullUrl,
			success: function(data){
				loadComment(post_id);
			},
			error: function(){
				alert('error saving comment');
			}
		});
	}

	document.addEventListener('DOMContentLoaded', function () {   
        var buttonRight = document.getElementById('rightArrow');
        buttonRight.onclick = function () {
            document.getElementById('horizontal-scroll-wrapper').scrollLeft += 128;
        };
        var buttonLeft = document.getElementById('leftArrow');
        buttonLeft.onclick = function () {
            document.getElementById('horizontal-scroll-wrapper').scrollLeft -= 128;
        };
    }, false);	

</script>
@endsection