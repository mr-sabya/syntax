@extends('frontend.layouts.app')

@section('title')
{{ $product->name }}
@endsection

@section('content')


<livewire:frontend.product.show productId="{{ $product->id }}" />

<livewire:frontend.product.related productId="{{ $product->id }}" />

@endsection