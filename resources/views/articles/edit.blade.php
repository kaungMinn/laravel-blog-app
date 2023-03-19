@extends('layouts.app')


@section('content')

    <div class="container">
        <h3 class="mt-3 mb-2">Add New Articles</h3>

        <form method="post">
            @csrf
            <div class="mb-2">
                <label for="">Article title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter a title" value="{{$article->title}}">
            </div>

            <div class="mb-2">
                <label for="">Article Body</label>
            <textarea name="body" placeholder=" Enter a body text" class="form-control" >{{$article->body}}</textarea>
            </div>

            <div class="mb-2">
                <label for="">Article Category</label>
                <select name="category_id" class="form-select">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($category->id == $article->category_id) selected @endif>{{$category->name}}</option>

                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection