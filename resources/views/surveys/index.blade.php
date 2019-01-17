@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Surveys</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group row">
                        <div class="col-md-12">
                            <a class="btn btn-success add-option" href="{{ url('/surveys/create') }}">Add Survey</a>
                        </div>
                    </div>

                    <table class="table table-striped table-responsive-md table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Votes</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surveys as $survey)
                                <tr>
                                    <th scope="row">{{ $survey->id }}</th>
                                    <td>{{ $survey->name }}</td>
                                    <td>{{ $survey->votes->count() }}</td>
                                    <td><a class="btn btn-primary btn-sm table-btn-sm" href="{{ url('/surveys/' . $survey->id) }}">View</a></td>
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
