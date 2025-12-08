@extends('frontend.layouts.app')

@section('content')


<livewire:frontend.product.show productId="{{ $product->id }}" />

<livewire:frontend.product.related productId="{{ $product->id }}" />

@endsection