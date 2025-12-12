@extends('backend.layouts.app')

@section('content')
<livewire:backend.software.manage softwareId="{{ $softwareId }}" />
@endsection