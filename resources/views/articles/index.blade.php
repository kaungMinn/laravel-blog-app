@extends ('layouts.app')


@section('content')

    <div class="container">

    {{$articles->links()}}
    @if(session('info'))
        <div class="alert alert-info">
            {{session('info')}}
        </div>
    @endif
    @foreach($articles as $article)

<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title">
            {{$article->title}}
        </h5>

        <div class="card-subtitle text-muted small">
            {{$article->created_at->diffForHumans()}},
            <b>Category</b>-{{$article->category->name}}
        </div>

        <p class="card-text mt-3 mb-2">
            {{$article->body}}
        </p>

        <a href="{{url("articles/detail/$article->id")}}" class="card-link">Read More &raquo;</a>
    </div>
</div>

@endforeach
    </div>

@endsection