@extends('layouts.app')

@section('content')

    <div class="container">
        @csrf 
        <h1 class="h3">Update the comment</h1>
        <form action="{{url("/comments/update/$comment->id")}}" method="post">
            @csrf
            <div class="mt-2">
                <label for="">Comment Content</label>
                <textarea name="content"  class="form-control">{{$comment->content}}</textarea>
            </div>


            <button class="mt-2 btn btn-primary">Update</button>
        </form>
    </div>

@endsection