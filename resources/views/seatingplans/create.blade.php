@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/seatingplan-editor.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Create Seating Plan</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/seatingplans') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <h4>Layout</h4>

                        <div class="btn-toolbar mb-2" role="toolbar" aria-label="Toolbar">
                            <div class="btn-group mr-2" role="group" aria-label="Add Group">
                                <button type="button" class="btn btn-success append-col">Add Column</button>
                                <button type="button" class="btn btn-success append-row">Add Row</button>
                            </div>

                            <div class="btn-group mr-2" role="group" aria-label="Type Group">
                                <button type="button" class="btn btn-info change-type-single-tbl">Single Table</button>
                                <button type="button" class="btn btn-info change-type-double-tbl">Double Table</button>
                                <button type="button" class="btn btn-info change-type-other">Other</button>
                            </div>

                            <div class="btn-group mr-2" role="group" aria-label="Rotates">
                                <button type="button" class="btn btn-warning rotate-90">Rotate 90°</button>
                            </div>

                            <div class="btn-group" role="group" aria-label="Merge">
                                <button type="button" class="btn btn-dark merge-cell">Merge</button>
                            </div>
                        </div>

                        <table class="seat-layout table-responsive">
                            <tbody></tbody>
                        </table>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Create</button>
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
    window.$lastSelected = undefined;

    window.numRows = function() {
        return $('.seat-layout tr').length;
    };

    window.numCols = function() {
        var firstRow = $('.seat-layout tr')[0];
        return $(firstRow).find('td').length;
    };

    function generateCell(x, y) {
        return '<td data-x="' + x + '" data-y="' + y + '">' +
                '<input class="seat-number loc-' + x + '-' + y + '" type="text" name="seatItem[' + x + '][' + y + '][name]">' +
                '<input class="seat-type loc-' + x + '-' + y + '" type="hidden" name="seatItem[' + x + '][' + y + '][type]">' +
                '<input class="seat-width loc-' + x + '-' + y + '" type="hidden" name="seatItem[' + x + '][' + y + '][width]" value="1">' +
                '<input class="seat-height loc-' + x + '-' + y + '" type="hidden" name="seatItem[' + x + '][' + y + '][height]" value="1">' +
            '</td>';
    }

    function setSeatType(type) {
        if (!window.$lastSelected) {
            alert('No location selected');
        } else {
            window.$lastSelected.removeClass();
            window.$lastSelected.addClass(type);
            window.$lastSelected.find('input.seat-type').val(type);
        }
    }

    $(function() {
        var defaultCols = 8;
        var defaultRows = 10;

        for (var i = 0; i < defaultRows; i++) {
            var $row = $('<tr>');

            for (var j = 0; j < defaultCols; j++) {
                $row.append(generateCell(j, i));
            }

            $('.seat-layout tbody').append($row);
        }
    });

    $('.seat-layout').on('click', 'td', function() {
        window.$lastSelected = $(this);
    });

    $('.append-col').click(function() {
        // calculate how many cols currently + 1
        var newCol = $($('.seat-layout tbody tr')[0]).find('td').length;

        // loop per row and append col to TRs
        $('.seat-layout').find('tr').each(function(i, tr) {
            $(tr).append(generateCell(newCol, i));
        });
    });

    $('.append-row').click(function() {
        // calculate how many rows currently + 1
        var newRow = $('.seat-layout tbody tr').length;
        var cols = $($('.seat-layout tbody tr')[0]).find('td').length;

        var $row = $('<tr>');
        for (var i = 0; i < cols; i++) {
            $row.append(generateCell(i, newRow));
        }

        // append new TR and loop per col
        $('.seat-layout tbody').append($row);
    });

    $('.change-type-single-tbl').click(function() {
        setSeatType('table');
    });

    $('.change-type-double-tbl').click(function() {
        setSeatType('dbl-table-1');
    });

    $('.change-type-other').click(function() {
        setSeatType('other');
    });

    $('.rotate-90').click(function() {
        if (!window.$lastSelected) {
            alert('No location selected');
            return false;
        }

        $ls = window.$lastSelected;

        if ($ls.hasClass('dbl-table-1')) {
            $ls.removeClass('dbl-table-1');
            $ls.addClass('dbl-table-2');

            $ls.find('input.seat-type').val('dbl-table-2');
        } else if ($ls.hasClass('dbl-table-2')) {
            $ls.removeClass('dbl-table-2');
            $ls.addClass('dbl-table-3');

            $ls.find('input.seat-type').val('dbl-table-3');
        } else if ($ls.hasClass('dbl-table-3')) {
            $ls.removeClass('dbl-table-3');
            $ls.addClass('dbl-table-4');

            $ls.find('input.seat-type').val('dbl-table-4');
        } else if ($ls.hasClass('dbl-table-4')) {
            $ls.removeClass('dbl-table-4');
            $ls.addClass('dbl-table-1');

            $ls.find('input.seat-type').val('dbl-table-1');
        }
    });

    $('.merge-cell').click(function() {
        if (!window.$lastSelected) {
            alert('No location selected');
            return false;
        }

        Swal.fire({
            title: 'Direction?',
            text: 'Pick a direction to merge in from your current position.',
            showCancelButton: true,
            input: 'radio',
            inputOptions: {
                'down': 'Down',
                'right': 'Right'
            },
            inputValidator: (value) => {
                return !value && 'Pick a direction.'
            }
        }).then((result) => {
            if (!result.value) {
                return false;
            }

            var direction = result.value;

            Swal.fire({
                title: 'Merge how many cells?',
                input: 'text',
                showCancelButton: true,
                inputValidator: (value) => {
                    return !Number.isInteger(Number(value)) && 'Please enter a number.';
                }
            }).then((result) => {
                if (!result.value) {
                    return false;
                }

                var numCells = parseInt(Number(result.value));
                var valid = false;
                var posX = parseInt(window.$lastSelected.attr('data-x'));
                var posY = parseInt(window.$lastSelected.attr('data-y'));

                var numCols = window.numCols();
                var numRows = window.numRows();

                // Check validity of merge based on current grid size
                if (direction === 'right') {
                    if ((posX + numCells) < numCols) {
                        valid = true;
                    }
                } else if (direction === 'down') {
                    if ((posY + numCells) < numRows) {
                        valid = true;
                    }
                }

                if (!valid) {
                    Swal.fire({
                        title: 'Invalid selection',
                        text: 'The combination selected extends off of the grid.',
                        type: 'error'
                    });

                    return false;
                }

                var existingColSpan = Number( window.$lastSelected.attr('colspan') || 1 );
                var existingRowSpan = Number( window.$lastSelected.attr('rowspan') || 1 );

                var newColSpan = existingColSpan + numCells;
                var newRowSpan = existingRowSpan + numCells;

                // Remove neighbouring cells and set new width / height + col/row span
                if (direction === 'right') {
                    window.$lastSelected.find('.seat-width').val(newColSpan);
                    window.$lastSelected.attr('colspan', newColSpan);

                    for (var i = posY; i < (posY + existingRowSpan); i++) {
                        for (var j = (posX + 1); j < (posX + newColSpan); j++) {
                            $('[data-x=' + j + '][data-y=' + i + ']').remove();
                            $('form').append('<input type="hidden" name="' + j + '|' + i + '" value="delete">');
                        }
                    }
                } else if (direction === 'down') {
                    window.$lastSelected.find('.seat-height').val(newRowSpan);
                    window.$lastSelected.attr('rowspan', newRowSpan);

                    for (var i = posX; i < (posX + existingColSpan); i++) {
                        for (var j = (posY + 1); j < (posY + newRowSpan); j++) {
                            $('[data-x=' + i + '][data-y=' + j + ']').remove();
                            $('form').append('<input type="hidden" name="' + j + '|' + i + '" value="delete">');
                        }
                    }
                }
            });
        });
    });
</script>
@endsection
