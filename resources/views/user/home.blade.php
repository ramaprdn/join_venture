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
        .buttonRounded {
            border-radius: 25px;
        }

        .card-rounded {
            border-radius: 25px;
        }
        .card-timeline-title {
            border-top-left-radius: 0px;
            border-top-right-radius: 25px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 25px;
            margin-top: 120px;
        }
        .image-home {
            max-height: 150px;
            border-top-right-radius: 25px;
            border-top-left-radius: 25px;
            object-fit: cover;
        }
        .image-profile {
            max-width: 120px; 
            margin-top: 90px;
            margin-left: 15px; 
            border: 5px solid;
            border-color: #FFFFFF;
            object-fit: cover;
        }
        .image-timeline {
            max-height: 300px;
            border-top-right-radius: 25px;
            border-top-left-radius: 25px;
            object-fit: cover;
            opacity: 0.5;
        }
        .image-story {
            width: 80px;
            height: 80px;
            display: inline-block;
            cursor: pointer;
        }
        .image-arrow {
            width: 20px;
            opacity: 0.6;
            display: block;
            margin: 0 auto;
        }

        .vertical-scroll-wrapper {
            width: 100%;
            height: 250px;
            overflow-y: auto;
            overflow-x: hidden;         
        }
        #horizontal-scroll-wrapper {
            height:80px;
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
<div class="container-fluid px-md-5 px-sm-1" style="margin-top: 80px;">
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
                        <br>
                        <h2><b>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</b></h2>
                        <p>"Living Like Larry"</p>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-lg" style="border-radius: 50px;"><b>></b></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-rounded my-2">
                <div class="card-body">
                    <div class="green-text">
                        <h2><b>Top Stories</b></h2>
                        <br>
                        <div class="row">
                            <div class="col-md-1 col-sm-1 px-0 pt-4">
                                <a href="#">
                                    <img id="leftArrow" src="{{asset('img/left-arrow.png')}}" class="image-arrow">
                                </a>
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
                                <a href="#">
                                    <img id="rightArrow" src="{{asset('img/right-arrow.png')}}" class="image-arrow">
                                </a>
                            </div>
                            
                        </div>
                        
                        <br>
                        <h2><b>Nearby Adventure</b></h2>
                        <div class="vertical-scroll-wrapper">
                            <div><a href="#" class="green-text"><h4>Denpasar</h4></a></div>
                            <hr>
                            <div><h4>Badung</h4></div>
                            <hr>
                            <div><h4>Gianyar</h4></div>
                            <hr>
                            <div><h4>Bangli</h4></div>
                            <hr>
                            <div><h4>Tabanan</h4></div>
                            <hr>
                            <div><h4>Karangasem</h4></div>
                            <hr>
                            <div><h4>Jembrana</h4></div>
                            <hr>
                            <div><h4>Klungkung</h4></div>
                            <hr>
                            <div><h4>Singaraja</h4></div>
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
	                         
	                    <input type="file" name="image_post[]" id="image-input" multiple="" accept="image/*">
	                    <div id="previewImage"></div>
	                </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-lg buttonRounded pull-right px-md-5 px-sm-1 mx-2"><b>PUSH</b></button>
                    </div>
            	</form>               
            </div>
            <br>

            @foreach($user_friend_post as $post)
            	<div class="card mb-2">
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
	                <div class="card-footer">
	                    <div class="row">
                    		<div class="col-sm-10">
                    			<input id="comment{{ $post->id }}" type="text" name="comment" class="form-control" placeholder="comment">
                    		</div>
                    		<div class="col-sm-2">
                    			<button type="button" class="btn btn-success" onclick="sendComment({{ $post->id.",".Auth::user()->id }})">Send</button>
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
            document.getElementById('horizontal-scroll-wrapper').scrollLeft += 168;
        };
        var buttonLeft = document.getElementById('leftArrow');
        buttonLeft.onclick = function () {
            document.getElementById('horizontal-scroll-wrapper').scrollLeft -= 168;
        };
    }, false);	

</script>
@endsection