@extends('frontend.layouts.app')

@section('title', 'Softwares')

@section('content')
<livewire:frontend.software.show id="{{ $software->id }}" />

@endsection