@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Survey: {{ $survey->name }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/surveys/' . $survey->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $survey->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <h4>Options</h4>

                        <table class="table table-striped table-responsive-md table-sm">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($survey->options as $option)
                                    <tr>
                                        <th scope="row" style="vertical-align: middle;">{{ $option->id }}</th>
                                        <td><input class="form-control" type="text" name="option[{{ $option->id }}]" value="{{ $option->name }}" required></td>
                                        <td><a class="btn btn-danger delete-option" href="" data-id="{{ $option->id }}">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success add-option">Add Option</button>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
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
<script type="text/javascript">
    $('.add-option').click(function(e) {
        e.preventDefault();

        var $row = $('<tr>');
        $row.append('<th>');
        $row.append('<td><input class="form-control" type="text" name="newOption[]" required></td>');
        $row.append('<td><a class="btn btn-danger delete-option" href="" data-id="">Delete</a></td>');

        $('tbody').append($row);
    });

    $('tbody').on('click', '.delete-option', function(e) {
        e.preventDefault();

        var $row = $(this).parent().parent();
        var id = $(this).attr('data-id');

        if (id.length === 0) {
            $row.remove();
        } else {
            Swal({
                title: 'Are you sure?',
                text: 'You will lose any existing votes for this option.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete it!'
            }).then((result) => {
                if (result.value) {
                    $('form').append('<input type="hidden" name="delete[]" value="' + id + '">');
                    $row.remove();
                }
            });
        }
    })
</script>
@endsection
