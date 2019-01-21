@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Static Pages</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group row">
                        <div class="col-md-12">
                            <a class="btn btn-success" href="{{ url('/staticpages/create') }}">Add Static Page</a>
                        </div>
                    </div>

                    <table class="table table-striped table-responsive-md table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Link</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staticPages as $page)
                                <tr>
                                    <th scope="row">{{ $page->id }}</th>
                                    <td>{!! $page->name !!}</td>
                                    <td>{{ $page->link }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm table-btn-sm" href="{{ url('/' . $page->link) }}" target="_blank">View</a>
                                        <a class="btn btn-secondary btn-sm table-btn-sm" href="{{ url('/staticpages/' . $page->id . '/edit') }}" target="_blank">Edit</a>
                                    </td>
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
