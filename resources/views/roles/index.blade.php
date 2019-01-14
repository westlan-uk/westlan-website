@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('Roles') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-responsive-md table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Members') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <th scope="row">{{ $role->id }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->users->count() }}</td>
                                    <td><a class="btn btn-primary btn-sm table-btn-sm" href="{{ url('/roles/' . $role->id) }}">{{ __('View') }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Add New Role') }}</h5>

                    <form class="form-inline" method="POST" action="{{ url('/roles') }}">
                        @csrf

                        <label class="sr-only" for="name">{{ __('Name') }}</label>
                        <input class="form-control mb-2 mr-sm-2{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}">

                        <button class="btn btn-primary mb-2" type="submit">{{ __('Add') }}</button>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
