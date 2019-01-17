@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-2">
                            <img class="full-dp" src="{{ url( $user->display_pic ?? '/img/no-dp.png' ) }}">
                        </div>

                        <div class="col-md-10">
                            <h1>{{ $user->username }}</h1>

                            @if (Auth::user()->role->site_admin || Auth::user()->id === $user->id)
                                <a href="{{ url('/users/' . $user->id . '/edit') }}">Edit Profile</a>
                            @endif

                            <p>This person has attended lots of LANs.<br />
                            He has ALL of the achievements.</p>
                        </div>
                    </row>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
