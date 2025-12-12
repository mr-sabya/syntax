@extends('frontend.layouts.app')

@section('title', 'Blog')

@section('content')

<livewire:frontend.blog.show id="{{ $post->id }}" />

@endsection