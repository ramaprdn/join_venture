@extends('layouts.app2')

@section('css')
<style type="text/css">
	.image-home {
        height: 180px;
        width: 100%;
        border-top-left-radius: 15px;
        object-fit: cover;
    }
    .image-profile {
        width: 80px;
        height: 80px; 
        margin-top: 140px;
        margin-left: 15px; 
        border: 2px solid;
        border-color: #FFFFFF;
        object-fit: cover;
    }
    .image-upload > input {
    	display: none;
    }
    .image-upload > label:hover{
        opacity: 0.5;
        transition: 0.5s;
    }
    .card-photo-set {
    	border-top-left-radius: 15px;
    	border-bottom-left-radius: 15px;
    } 

    .card-medsoc-set {
    	border-top-right-radius: 15px;
    	border-bottom-right-radius: 15px;
    }

    .header-setting {
    	border-bottom: 1px solid #E0E0E0;
    }
    
    @media (max-width: 767px) {
        .image-home {
        	border-top-right-radius: 15px;
        }
        .card-photo-set {
	    	border-radius: 15px;
	    } 

	    .card-personal-set {
	    	border-radius: 15px;
	    }

	    .card-medsoc-set {
	    	border-radius: 15px;
	    }

	    .margin-small {
	    	margin: 5px;
	    }
    }
</style>
@endsection

@section('section')

<form action="{{ route('update_profile') }}" method="post" enctype="multipart/form-data">
	@csrf
	{{ method_field('PUT') }}
	<div class="container" style="margin-top: 80px;">
		<div class="card-group row margin-small">
			<div class="card col-md-3 px-0 card-photo-set">
				<img id="background-image" style="position: relative;" class="image-home" src="/img/users/{{ Auth::user()->img_home }}"> 
                <div style="position: absolute;">
                    <img id="profile-image" class="rounded-circle image-profile" src="/img/users/{{ Auth::user()->img_profile }}" style="background-color: #CCC">
                </div>
                
				<div class="card-body">
					<br>
                    <div class="row">
	                	<div class="col-3 px-0 text-center grey-text">
	                		<div>
	                			<small><b>Story</b></small>
	                		</div>
	                		<div>
	                			<small class="green-text">10</small>
	                		</div>
	                	</div>
	                	<div class="col-3 px-0 text-center grey-text">
	                		<div>
	                			<small><b>Followers</b></small>
	                		</div>
	                		<div>
	                			<small class="green-text">100.5k</small>
	                		</div>
	                	</div>
	                	<div class="col-3 px-0 text-center grey-text">
	                		<div>
	                			<small><b>Following</b></small>
	                		</div>
	                		<div>
	                			<small class="green-text">1500</small>
	                		</div>
	                	</div>
	                	<div class="col-3 px-0 text-center grey-text">
	                		<div>
	                			<small><b>Event</b></small>
	                		</div>
	                		<div>
	                			<small class="green-text">10</small>
	                		</div>
	                	</div>
	                </div>
	                <br>
	                <div class="d-flex justify-content-center">
	                	<div class="image-upload">
                    		<label for="profile-input" class="btn btn-outline-secondary buttonRounded">Change Profile Image</label>
                         	<input type="file" name="img_profile" id="profile-input" multiple="" accept="image/*">
                   		</div>
	                </div>
	                <div class="d-flex justify-content-center" style="margin-top: 10px;">
	                	<div class="image-upload">
                    		<label for="background-input" class="btn btn-outline-secondary buttonRounded">Change Home Image</label>
                         	<input type="file" name="img_home" id="background-input" multiple="" accept="image/*">
                   		</div>
	                </div>
	                <br>
	                <hr>
	                <div class="text-center grey-text">
	                	<small><b>Motto:</b></small>
	                	<h5 style="margin-top: 20px;"><b>"Living like Larry"</b></h5>
	                </div>
	                <div class="d-flex justify-content-center" style="margin-top: 20px;">
	                	<button class="btn btn-outline-secondary buttonRounded px-4">Edit</button>
	                </div>
				</div>
			</div>
			<div class="card col-md-5 grey-text card-personal-set px-0">
				<h5 class="header-setting p-2"><b>Personal Setting</b></h5>
				<div class="card-body">
					
						
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<h6><b>First Name</b></h6>
								<input class="form-control" type="text" name="first_name" value="{{ Auth::user()->first_name }}">
							</div>
							<div class="col-md-6">
								<h6><b>Last Name</b></h6>
								<input class="form-control" type="text" name="last_name" value="{{ Auth::user()->last_name }}">
							</div>
						</div>
					</div>

					<div class="form-group">
						<h6><b>Email</b></h6>
						<input class="form-control" type="text" name="email" value="{{ Auth::user()->email }}">
					</div>

					<div class="form-group">
						<h6><b>Biografi</b></h6>
						<textarea class="form-control" placeholder="write about your self here">{{ Auth::user()->bio }}</textarea>
					</div>

					<div class="form-group">
						<h6><b>Phone Number</b></h6>
						<input class="form-control" type="text" name="phone_number">
					</div>

					<div class="form-group">
						<input type="radio" name="gender" value="1" {{( Auth::user()->gender == 1 ) ? 'checked': ''}}> Male
						<input type="radio" name="gender" value="0" {{( Auth::user()->gender == 0 ) ? 'checked': ''}}> Female
					</div>

					<div class="form-group">
						<h6><b>Date of Birth</b></h6>
						<input class="form-control" type="text" name="birthday" value="{{ date("M jS, Y", strtotime(Auth::user()->birthday)) }}">
					</div>

					<div class="form-group">
						<h6><b>Address</b></h6>
						<textarea class="form-control" placeholder="write your address here"></textarea>
						<select name="provinsi">
							<option>-provinsi-</option>
							<option>Bali</option>
						</select>

						<select name="kabupaten">
							<option value="0">-kabupaten-</option>
							@foreach($kabupaten as $kb)
								<option value="{{ $kb->id }}">{{ $kb->district_name }}</option>
							@endforeach
						</select>

					</div>
					<div class="d-flex justify-content-end">
						<button class="btn btn-outline-secondary buttonRounded" style="margin-right: 10px;">Cancel</button>
						<button class="btn buttonRounded" type="submit">Update Information</button>
					</div>
				</div>
			</div>
			<div class="card col-md-4 grey-text card-medsoc-set px-0">
				<h5 class="header-setting p-2"><b>Social Media Link</b></h5>
				<div>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript" async>

	function previewBackground(input){
		if(input.files && input.files[0]){
			var reader = new FileReader();

			reader.onload = function(e){
				$('#background-image').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$('input[name=img_home]').change(function(){
		previewBackground(this);
	});

	function preview(input){
		if(input.files && input.files[0]){
			var reader = new FileReader();

			reader.onload = function(e){
				$('#profile-image').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}


	$('input[name=img_profile]').change(function(){
		preview(this);
	});

</script>
@endsection