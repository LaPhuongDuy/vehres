@extends('layouts.app')
@section('javascript')
    <script src={{ asset('/js/partners/all.js') }}></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Partner Dashboard</div>
                    <div class="panel-body">
                            <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Index</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Phone number</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0; $i < count($garages); $i ++)
                                @php($garage = $garages[$i])
                                <tr>
                                    <td>{{ $garages->perPage() * ($garages->currentPage() - 1) + $i + 1 }}</td>
                                    <td>{{ $garage->name }}</td>
                                    <td>{{ $garage->description }}</td>
                                    <td>{{ $garage->phone_number }}</td>
                                    <td>
                                        <a href="{{ action('Partner\GarageController@edit',['id' => $garage->id]) }}"
                                           class="btn-edit btn btn-primary">{{ trans('layout.edit') }}</a>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-danger btn-delete"
                                           name="btn-delete" id="btn-delete"
                                           data-garage-id="{{ $garage->id }}">{{ trans('layout.delete') }}</a>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                        {{ $garages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
