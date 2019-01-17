@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ $shorturi->name }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p><a class="btn btn-primary" href="{{ url('/shorturis/' . $shorturi->id . '/edit') }}">Edit Short URI</a> <a class="btn btn-danger reset-clicked" href="{{ url('/shorturis/' . $shorturi->id . '/reset') }}">Reset Clicked</a></p>

                    <table>
                        <tr>
                            <th scope="row">Short Link</th>
                            <td class="pl-3">{{ env('APP_URL') . '/' . $shorturi->shortcode }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Destination Link</th>
                            <td class="pl-3">{{ $shorturi->uri }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Times Clicked</th>
                            <td class="pl-3">{{ $shorturi->clicked }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Created</th>
                            <td class="pl-3">{{ $shorturi->created_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('.reset-clicked').click(function(e) {
        e.preventDefault();

        Swal({
            title: 'Are you sure?',
            text: 'You will not be able to retrieve the previous clicked count.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Reset it!'
        }).then((result) => {
            if (result.value) {
                location.href = $(this).attr('href');
            }
        });
    })
</script>
@endsection
