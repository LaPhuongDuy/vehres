@extends('partners.layouts.master')
@section('javascript')
    <script src={{ asset('/js/partners/all.js') }}></script>
@endsection
@section('tag')
    @if ($garage->status == config('common.garage.status.activated'))
        <a href="{{ action('Partner\GarageController@index', ['status' => config('common.garage.status.activated')]) }}">
            {{ trans('admin.garages.activated_garages') }}
        </a>
        <i class="fa fa-angle-right"></i>
    @else
        <a href="{{ action('Partner\GarageController@index', ['status' => config('common.garage.status.unactivated')]) }}">
            Unactivated Garages
        </a>
        <i class="fa fa-angle-right"></i>
    @endif
    <label>{{ $garage->name }}</label>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Information</div>
                    <div class="panel-body">
                        {!! Form::open([
                            'action' => ['Partner\GarageController@update', $garage->id],
                            'method' => 'PUT',
                            'class' => 'form-horizontal form-label-left',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-10 col-md-offset-1">
                                {!! Form::text('name', $garage -> name, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Garage Name',
                                ]) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-10 col-md-offset-1">
                                {!! Form::text('phone', $garage->phone_number, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Phone number',
                                ]) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-2 col-md-offset-1" id="selectProvincesField">
                                @if($garage->province !== null)
                                    {!! Form::select('province_id', $place[0], $garage->province->id, [
                                        'class' => 'form-control',
                                        'id' => 'province_id',
                                    ]) !!}
                                @endif
                            </div>
                            <div class="col-md-2 col-md-offset-1" id="selectDistrictsField">
                                @if($garage->district !== null)
                                    {!! Form::select('district_id', $place[1], $garage->district->id, [
                                        'class' => 'form-control',
                                        'id' => 'district_id',
                                    ]) !!}
                                @endif
                            </div>
                            <div class="col-md-2 col-md-offset-1" id="selectWardsField">
                                @if($garage->ward !== null)
                                    {!! Form::select('ward_id', $place[2], $garage->ward->id, [
                                        'class' => 'form-control',
                                        'id' => 'ward_id',
                                    ]) !!}
                                @endif
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-10 col-md-offset-1">
                                {!! Form::text('address', $garage -> address, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Garage address',
                                ]) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-10 col-md-offset-1">
                                {!! Form::text('website', $garage -> website, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Website',
                                ]) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-10 col-md-offset-1">
                                {!! Form::text('working_time', $garage-> working_time, [
                                    'placeholder' => 'From hour',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-10 col-md-offset-1">
                                {!! Form::textarea('short_description', $garage -> short_description, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Write your short description in here',
                                    'rows' => '5',
                                ]) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-10 col-md-offset-1">
                                {!! Form::textarea('description', $garage -> description, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Write your description in here'
                                ]) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            @can('update', $garage))
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            @endcan
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
