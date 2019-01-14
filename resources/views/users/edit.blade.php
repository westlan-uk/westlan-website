@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit User:') }} {{ $user->username }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/users/' . $user->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        @if (Auth::user()->role->site_admin)
                            <div cass="row">
                                <div class="offset-md-4 col-md-6">
                                    <h4>{{ __('Site Admin Only') }}</h4>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="banned_reason" class="col-md-4 col-form-label text-md-right">{{ __('Ban Reason') }}</label>

                                <div class="col-md-6">
                                    <input id="banned_reason" type="text" class="form-control{{ $errors->has('banned_reason') ? ' is-invalid' : '' }}" name="banned_reason" value="{{ $user->banned_reason }}">

                                    @if ($errors->has('banned_reason'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('banned_reason') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <hr>
                        @endif

                        <div class="form-group row mb-0">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Display Picture') }}</label>

                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('display_pic') ? ' is-invalid' : '' }}" type="file" name="display_pic">

                                @if ($errors->has('display_pic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('display_pic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mt-0">
                            <div class="offset-md-4 col-md-6">
                                <small>{{ __('150 x 150px recommended - 1MB maximum filesize') }}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $user->username }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Real Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group form-check offset-md-4 col-md-6">
                            <input id="mailing_list" type="checkbox" name="mailing_list" value="1" {{ $user->mailing_list ? 'checked' : '' }}>
                            <label class="form-check-label" for="mailing_list">{{ __('Sign me up to the mailing list!') }}</label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
