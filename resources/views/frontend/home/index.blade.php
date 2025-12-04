@extends('frontend.layouts.app')

@section('content')
<!--======= new-slide section start =======-->
<livewire:frontend.home.slide-section />
<!--======== new-slide section end ========-->

<!-- ======== deals section start ======== -->
<livewire:frontend.home.deal-section />
<!-- ======== deals section end ========== -->

<!--======== gadget section start ========-->
<livewire:frontend.home.gadget-section />
<!--======== gadget section end ========-->

<!--======== new-arrival section start ======-->
<livewire:frontend.home.new-arrival-section />
<!--======== new-arrival section end ========-->

<!--======== recommended items section start ========-->
<livewire:frontend.home.recommended-section />
<!--======== recommended items section end ========-->

<!--======== software section start ========-->
<livewire:frontend.home.software-section />
<!--======== software section end ========-->

<!--======== partners section start ========-->
<livewire:frontend.home.partner-section />
<!--======== partners section end ========-->

<!--======== clients section start ========-->
<livewire:frontend.home.client-section />
<!--======== clients section end ========-->

<!-- ======== news section start ============ -->
<livewire:frontend.home.news-section />
<!-- ======== news section end ============ -->

<!-- ======== subscribe section start ============ -->
<livewire:frontend.home.subscribe-section />
<!-- ======== subscribe section end ============ -->
@endsection