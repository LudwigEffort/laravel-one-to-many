@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $category->name }}</h1>
        <h2>Category: {{ $category->name }}</h2>
        <p>
            {{ $category->description }}
        </p>

        <ul>
            @foreach ($category->posts as $post)
                <li><a href="{{ route('admin.posts.show', ['post' => $post]) }}">{{ $post->title }}</a></li>
            @endforeach
        </ul>

    </div>
@endsection
