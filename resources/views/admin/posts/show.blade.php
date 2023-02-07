@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        @if (isset($post->category->name))
            <h2>Category: {{ $post->category->name }}</h2>
        @endif

        @if ($post->tags->all())
            <h2>Tags</h2>
            @foreach ($post->tags as $tag)
                {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
            @endforeach
        @endif

        {{-- <img src="{{ $post->image }}" alt="{{ $post->title }}"> --}}
        <img src="{{ asset('storage/'. $post->uploaded_img) }}" alt="{{ $post->title }}">
        <p>
            {{ $post->content }}
        </p>
    </div>
@endsection
