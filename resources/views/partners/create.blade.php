@extends('layouts.app')
@section('')
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
                        {!! Form::open(['action'=>['Partner\GarageController@store'],
                            'method'=>'POST',
                            'class'=>'form-horizontal form-label-left'])
                        !!}
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::text('name','',['class'=>'form-control','placeholder'=>'Garage Name']) !!}
                            </div>
                            <div class="col-md-8 col-md-offset-2" style="float: left;">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong style="color: #761c19">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::text('phone','',['class'=>'form-control','placeholder'=>'Phone number']) !!}
                            </div>
                            <div class="col-md-8 col-md-offset-2" style="float: left;">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                    <strong style="color: #761c19">{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-4 col-md-offset-2">
                                {!! Form::select('province',$place[0], null, ['class'=>'form-control','id'=>'province']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-4 col-md-offset-2">
                                {!! Form::select('district',$place[1], null, ['class'=>'form-control','id'=>'district']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-4 col-md-offset-2">
                                {!! Form::select('ward',$place[2], null, ['class'=>'form-control','id'=>'ward']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::text('address','',['class'=>'form-control','placeholder'=>'Garage address']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::text('website','',['class'=>'form-control','placeholder'=>'Website']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-2 col-md-offset-2">
                                {!! Form::select('fromHour',config('common.timeworking.fromHour'),null,['placeholder' => 'From hour', 'class'=>'form-control']) !!}
                            </div>
                            <div class="col-md-2 col-md-offset-2" style="margin-left: 0px">
                                {!! Form::select('fromMin',config('common.timeworking.Min'),null,['class'=>'form-control','placeholder' => 'From min']) !!}
                            </div>
                            <div class="col-md-2 col-md-offset-2" style="margin-left: 0px">
                                {!! Form::select('toHour',config('common.timeworking.toHour'),null,['class'=>'form-control','placeholder' => 'To hour']) !!}
                            </div>
                            <div class="col-md-2 col-md-offset-2" style="margin-left: 0px">
                                {!! Form::select('toMin',config('common.timeworking.Min'),null,['class'=>'form-control','placeholder' => 'To min']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::textarea('short_description','',['class'=>'form-control','placeholder'=>'Write your short description in here','rows'=>'5']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::textarea('description','',['class'=>'form-control','placeholder'=>'Write your description in here']) !!}
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 15px">
                            <div class="col-md-8 col-md-offset-8">
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



