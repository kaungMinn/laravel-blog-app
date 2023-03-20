@extends('layouts.app')

@section('content')
<div class="container">

@if(session('info'))

    <div class="alert alert-success">
        <li class="list-group-item p-3 list-group-item-info">{{session('info')}}</li>
    </div>

@endif


        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                   <li class="list-group-item list-group-item-warning p-2">
                   {{$error}}
                   </li>
                @endforeach
            </div>
        @endif

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

        <a href="{{url("/articles/delete/$article->id")}}" class="btn btn-warning">Delete</a>
        <a href="{{url("articles/edit/$article->id")}}" class="btn btn-primary">Edit</a>
    </div>

    
</div>

    <ul class="list-group mt-2">
            <li class="list-group-item active">Comments: ({{$article->comments->count()}})</li>
            @foreach($article->comments as $comment)
                <li class="list-group-item">
                    
                    <div class="btn-group float-end d-flex align-items-center ms-3 border border-info bg-warning">
                        <a href="{{url("comments/edit/$comment->id")}}" class="btn btn-info btn-sm ">Edit</a>
                        <a href="{{url("comments/delete/$comment->id")}}" class="btn-close p-2"></a>
                    </div>
                    {{$comment->content}}

                    <div class="small mt-2">
                        By <b>{{$comment->user->name}}</b>,{{$comment->created_at->diffForHumans()}}
                    </div>
                </li>
            @endforeach
        </ul>

        @auth 
        <form action="{{url('/comments/create')}}" method="post">
            @csrf 

            <input type="hidden" name="article_id" value="{{$article->id}}">
            <input type="hidden" name="user_id" value={{auth()->user()->id}}>
            <textarea name="content" class="form-control mt-2"></textarea>

            <button class="btn btn-primary mt-2">Add Comment</button>

        </form>

        @endauth
    </div>

@endsection