@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Role: {{ $role->name }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/roles/' . $role->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $role->name }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div cass="row">
                            <div class="offset-md-4 col-md-6">
                                <h4>Site Permissions</h4>
                            </div>
                        </div>

                        <div class="form-group form-check offset-md-4 col-md-6">
                            <input id="site_admin" type="checkbox" name="site_admin" value="1" {{ $role->site_admin ? 'checked' : '' }}>
                            <label class="form-check-label" for="site_admin">Site Admin</label>
                        </div>

                        <div class="form-group form-check offset-md-4 col-md-6">
                            <input id="gallery_admin" type="checkbox" name="gallery_admin" value="1" {{ $role->gallery_admin ? 'checked' : '' }}>
                            <label class="form-check-label" for="gallery_admin">Gallery Admin</label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
