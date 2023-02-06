@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <h2>Category: {{ $post->category->name }}</h2>
        {{-- <img src="{{ $post->image }}" alt="{{ $post->title }}"> --}}
        <img src="{{ asset('storage/'. $post->uploaded_img) }}" alt="{{ $post->title }}">
        <p>
            {{ $post->content }}
        </p>
    </div>
@endsection
