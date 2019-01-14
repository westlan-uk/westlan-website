@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ _('Users') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/users/search" method="POST" role="search">
                        {{ csrf_field() }}

                        <div class="input-group">
                            <input type="text" class="form-control" name="q" placeholder="Search users">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <p class="mt-3">{{ __('Displaying') . ' ' . $users->count() . ' ' . __('of') . ' ' . $users->total() . ' ' . __('results') }}.</p>

                    <table class="table table-striped table-responsive-md table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Username') }}</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('E-Mail') }}</th>
                                <th scope="col">{{ __('Last Login') }}</th>
                                <th scope="col">{{ __('Registered') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->last_login }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td><a class="btn btn-primary btn-sm table-btn-sm" href="{{ url('/users/' . $user->id) }}">{{ __('View') }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
