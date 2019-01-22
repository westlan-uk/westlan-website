@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Seating Plans</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group row">
                        <div class="col-md-12">
                            <a class="btn btn-success" href="{{ url('/seatingplans/create') }}">Add Seating Plan</a>
                        </div>
                    </div>

                    <table class="table table-striped table-responsive-md table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Seats</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $plan)
                                <tr>
                                    <th scope="row">{{ $plan->id }}</th>
                                    <td>{{ $plan->name }}</td>
                                    <td>{{ $plan->name }}</td>
                                    <td><a class="btn btn-primary btn-sm table-btn-sm" href="{{ url('/seatingplans/' . $plan->id) }}">View</a></td>
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
