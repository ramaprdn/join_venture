@extends('layouts.app2')

@section('adventure')
active
@endsection

@section('css')
<style type="text/css">
	.image-home {
        max-height: 110px;
        border-top-right-radius: 15px;
        border-top-left-radius: 15px;
        object-fit: cover;
    }

    .image-profile {
        max-width: 80px; 
        margin-top: 70px;
        margin-left: 150%;
        border: 2px solid;
        border-color: #FFFFFF;
        object-fit: cover;
    }
</style>
@endsection

@section('section')
<div class="container" style="margin-top: 80px;">
	<div class="card" style="background-color: #fff">
		<div class="card-header" style="background-color: #fff">
			<div class="row">
				<div class="col-sm-7">
					Draft
					<h4>Create An Adventure</h4>
				</div>	
				<div class="col-sm-5">
					<div class="pull-right">
						<button class="btn btn-outline-success">Draft</button>
						<button class="btn btn-success">Post</button>	
					</div>
				</div>	
			</div>
		</div>

		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
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
		                    </div>
		                </div>
		            </div>
				</div>

				<div class="col-md-8">
					<div style="margin-left: 20px;">
						<div class="form-group">
							<label for="adventure_name">Judul Petulangan</label>
							<input type="text" name="adventure_name" class="form-control" id="adventure_name" placeholder="Judul Petualangan">
						</div>

						<div class="form-group">
							<label for="destination">Destinasi</label>
							<input type="text" name="destination" class="form-control" id="destination" placeholder="Destinasi">
						</div>

						<div class="row mb-2">
							<div class="col-md-6">
								Mulai
								<div class="row">
									<div class="col-md-7">
										<input type="date" name="starting_date" class="form-control">	
									</div>
									<div class="col-md-5">
										<input type="time" name="starting_time" class="form-control">	
									</div>
								</div>
							</div>

							<div class="col-md-6">
								Berakhir
								<div class="row">
									<div class="col-md-7">
										<input type="date" name="ending_date" class="form-control">	
									</div>
									<div class="col-md-5">
										<input type="time" name="ending_time" class="form-control">	
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="description">Deskripsi Adventure</label>
							<textarea class="form-control" name="description" placeholder="deskripsi petualangan anda"></textarea>
						</div>

						<div class="form-group">
							<label for="image">Unggah Gambar</label>
							<input type="file" name="image" class="form-control">
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection