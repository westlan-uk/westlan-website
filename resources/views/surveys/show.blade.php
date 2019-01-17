@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ $survey->name }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($vote)
                        <h4>Results</h4>

                        <hr>

                        <ul>
                            @foreach ($survey->options as $option)
                                <li>
                                    {{ $option->name }} - {{ $option->votes->count() }}
                                    @if ($vote->survey_option_id === $option->id)
                                        <-----------
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <p><a class="btn btn-danger" href="/surveys/{{ $survey->id }}/clear">Clear Vote</a></p>
                    @else
                        <h4>Options</h4>

                        <hr>

                        <table>
                            <thead>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($survey->options as $option)
                                    <tr>
                                        <td>{{ $option->name }}</td>
                                        <td class="pl-3"><a class="btn btn-primary" href="/surveys/{{ $survey->id }}/vote/{{ $option->id }}">Vote</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if (Auth::user()->role->site_admin)
                        <hr>

                        <p><a class="btn btn-primary" href="{{ url('/surveys/' . $survey->id . '/edit') }}">Edit Survey</a></p>

                        <h4>Existing Votes</h4>
                        <table class="table table-striped table-responsive-md table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Choice</th>
                                    <th scope="col">Timestamp Voted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($survey->votes->sortBy('survey_option_id') as $vote)
                                    <tr>
                                        <th scope="row">{{ $vote->id }}</th>
                                        <td>{{ $vote->user->username }}</td>
                                        <td>{{ $vote->option->name }}</td>
                                        <td>{{ $vote->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
