@extends('layouts.app')
@section('javascript')
    <script src={{ asset('/js/partners/all.js') }}></script>
    <script src={{ asset('bowers/tinymce/tinymce.js') }}></script>
    <script src={{ asset('js/partners/tinymce.js') }}></script>
@endsection
@section('content')
    <div class="row">
        {!! Form::open(['action'=>['Partner\ArticleController@store'],
 +                            'class'=>'form-horizontal form-label-left']) !!}
        <div class="col-md-6 col-md-offset-3">
            {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title article']) !!}
            <br/>
            {!!
                Form::text('short_description', '', ['class' => 'form-control',
                    'placeholder' => 'Short description'])
            !!}
            <br/>
            {!! Form::textarea('content') !!}
            <br/>
            {!!
                Form::button('Create',['class' => 'btn btn-primary',
                    'name' => 'btn_create', 'style' => 'float: right',
                    'type' => 'submit'])
            !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection