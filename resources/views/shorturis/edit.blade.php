@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Short URI: {{ $shorturi->name }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/shorturis/' . $shorturi->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $shorturi->name }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shortcode" class="col-md-4 col-form-label text-md-right">Shortcode</label>

                            <div class="col-md-6">
                                <input id="shortcode" type="text" class="form-control{{ $errors->has('shortcode') ? ' is-invalid' : '' }}" name="shortcode" value="{{ $shorturi->shortcode }}">

                                @if ($errors->has('shortcode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('shortcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="uri" class="col-md-4 col-form-label text-md-right">Link</label>

                            <div class="col-md-6">
                                <input id="uri" type="text" class="form-control{{ $errors->has('uri') ? ' is-invalid' : '' }}" name="uri" value="{{ $shorturi->uri }}">

                                @if ($errors->has('uri'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('uri') }}</strong>
                                    </span>
                                @endif
                            </div>
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
