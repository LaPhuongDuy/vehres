@extends('layouts.app')
@section('javascript')
    <script src={{ asset('/js/partners/all.js') }}></script>
@endsection
@section('content')
    <div class="container">
        @for($i = 0; $i < count($articles); $i++)
            @php($article = $articles[$i])
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading"> {{ $article->title }} </div>
                        <div class="panel-body"> {{ $article->content }} </div>
                        <div class="panel-footer">
                            <a class="btn btn-default">Detail</a>
                            <a class="btn-edit btn btn-primary">Edit</a>
                            <a class="btn-danger btn">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
        <div class="col-md-12 col-md-offset-4">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
