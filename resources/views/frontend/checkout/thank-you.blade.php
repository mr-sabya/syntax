@extends('frontend.layouts.app')

@section('title', 'About')

@section('content')

<livewire:frontend.checkout.thank-you :orderId="$order->id" />

@endsection