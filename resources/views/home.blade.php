@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" name="post_title" placeholder="Title">
                        </div>

                        <div class="form-group">
                            <textarea name="post_desc" class="form-control" placeholder="Write your story"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Post</button>
                        </div>    
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
