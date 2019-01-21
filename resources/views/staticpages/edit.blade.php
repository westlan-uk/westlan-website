@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Static Page: {{ $page->name }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/staticpages/' . $page->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $page->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-md-4 col-form-label text-md-right">Link</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" name="link" value="{{ $page->link }}" required>

                                @if ($errors->has('link'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <h4>Content</h4>

                        <textarea id="editor" name="content">{!! $page->content !!}</textarea>

                        <div class="form-group row mb-0 mt-3">
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

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>

<script type="text/javascript">
    ClassicEditor
        .create( document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '{{ env('APP_URL') . '/staticpages/upload' }}'
            }
        })
        .then( editor => {
            console.log( editor );
        })
        .catch( error => {
            console.error( error );
        });
</script>
@endsection
