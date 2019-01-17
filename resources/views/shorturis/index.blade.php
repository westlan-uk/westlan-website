@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Short URIs</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group row">
                        <div class="col-md-12">
                            <a class="btn btn-success" href="{{ url('/shorturis/create') }}">Add Short URI</a>
                        </div>
                    </div>

                    <table class="table table-striped table-responsive-md table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Shortcode</th>
                                <th scope="col">Clicked</th>
                                <th scope="col">Created</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shorturis as $shorturi)
                                <tr>
                                    <th scope="row">{{ $shorturi->id }}</th>
                                    <td>{{ $shorturi->name }}</td>
                                    <td>{{ $shorturi->shortcode }}</td>
                                    <td>{{ $shorturi->clicked }}</td>
                                    <td>{{ $shorturi->created_at }}</td>
                                    <td><a class="btn btn-primary btn-sm table-btn-sm" href="{{ url('/shorturis/' . $shorturi->id) }}">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
