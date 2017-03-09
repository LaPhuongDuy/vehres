@extends('layouts.app')
@section('javascript')
    <script src={{ asset('/js/all.js') }}></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create garage</div>
                    <div class="panel-body">
                        {!! Form::open(['action'=>['Partner\GarageController@update',$garage->id], 'method'=>'PUT', 'class'=>'form-horizontal form-label-left','enctype'=>'multipart/form-data']) !!}
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::text('name',$garage -> name,['class'=>'form-control','placeholder'=>'Garage Name']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::text('phone',$garage -> phone_number,['class'=>'form-control','placeholder'=>'Phone number']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-2 col-md-offset-2">
                                {!! Form::select('province',$place[0], $garage->getAdministrationUnits()['province']->id, ['class'=>'form-control','id'=>'province']) !!}
                            </div>
                            <div class="col-md-2 col-md-offset-1">
                                {!! Form::select('district', $place[1],$garage->getAdministrationUnits()['district']->id,['class'=>'form-control','id'=>'district']) !!}
                            </div>
                            <div class="col-md-2 col-md-offset-1">
                                {!! Form::select('ward',$place[2], $garage->getAdministrationUnits()['ward']->id, ['class'=>'form-control','id'=>'ward']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::text('address',$garage -> address,['class'=>'form-control','placeholder'=>'Garage address']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::text('website',$garage -> website,['class'=>'form-control','placeholder'=>'Website']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-2 col-md-offset-2">
                                {!! Form::select('fromHour',config('common.timeworking.fromHour'), $timeworking[0], ['placeholder' => 'From hour', 'class'=>'form-control']) !!}
                            </div>
                            <div class="col-md-2 col-md-offset-2" style="margin-left: 0px">
                                {!! Form::select('fromMin',config('common.timeworking.Min'),$timeworking[1],['class'=>'form-control','placeholder' => 'From min']) !!}
                            </div>
                            <div class="col-md-2 col-md-offset-2" style="margin-left: 0px">
                                {!! Form::select('toHour',config('common.timeworking.toHour'),$timeworking[2],['class'=>'form-control','placeholder' => 'To hour']) !!}
                            </div>
                            <div class="col-md-2 col-md-offset-2" style="margin-left: 0px">
                                {!! Form::select('toMin',config('common.timeworking.Min'),$timeworking[3],['class'=>'form-control','placeholder' => 'To min']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::textarea('short_description',$garage -> short_description ,['class'=>'form-control','placeholder'=>'Write your short description in here','rows'=>'5']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::textarea('description',$garage -> description,['class'=>'form-control','placeholder'=>'Write your description in here']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
