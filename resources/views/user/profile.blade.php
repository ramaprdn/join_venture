@extends('layouts.app')

@section('content')

<form action="{{ route('update_profile') }}" method="post">
	@csrf
	{{ method_field('PUT') }}

	<input type="text" name="first_name" value="{{ Auth::user()->first_name }}">
	<input type="text" name="last_name" value="{{ Auth::user()->last_name }}">

	<div>
		<input type="text" name="email" value="{{ Auth::user()->email }}">
	</div>

	<div>
		<textarea placeholder="write about your self here">{{ Auth::user()->bio }}</textarea>
	</div>

	<input type="radio" name="gender" value="1" {{( Auth::user()->gender == 1 ) ? 'checked': ''}}> Male
	<input type="radio" name="gender" value="0" {{( Auth::user()->gender == 0 ) ? 'checked': ''}}> Female

	<div>
		<input type="text" name="birthday" value="{{ date("M jS, Y", strtotime(Auth::user()->birthday)) }}">
	</div>

	<div>

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

	<button class="btn btn-success">simpan</button>	
</form>

@endsection