@extends('layouts.app')
@section('javascript')
    <script src={{ asset('/js/all.js') }}></script>
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
                                <th>Provine</th>
                                <th>Eidt</th>
                                <th>Delete</th>
                            </tr>
                            </thead>


                            <tbody>
                            <?php
                            $idx = 10 * ($garages->currentPage() - 1) + 1;
                            ?>
                            @foreach($garages as $garage)
                                <tr>
                                    <td>{{ $idx }}</td>
                                    <td>{{ $garage->name }}</td>
                                    <td>{{ $garage->description }}</td>
                                    <td>{{ $garage->phone_number }}</td>
                                    <td>{{ $garage->district->name}}</td>
                                    <td>
                                        <a href="{{ action('Partner\GarageController@edit',['id' => $garage->id]) }}"
                                           class="btn-edit btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-danger btn-delete"
                                           name="btn-delete" id="btn-delete"
                                           data-garage-id="{{ $garage->id }}">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                $idx += 1;
                                ?>
                            @endforeach
                            </tbody>

                        </table>
                        {{ $garages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
