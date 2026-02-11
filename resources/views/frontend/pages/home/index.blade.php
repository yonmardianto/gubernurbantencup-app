@extends('frontend.layouts.master')

@section('title')
    Home
    @parent
@stop

@section('content')
    <!--- Hero Section -->
    @include('frontend.pages.home.sections.hero-section')
    <!-- End Hero Section -->

    <!-- Category Section -->
    {{-- @include('frontend.pages.home.sections.category-section') --}}
    <!-- End Category Section -->

    <!-- About Section -->
    {{-- @include('frontend.pages.home.sections.about-section') --}}

    <!-- Course Section -->
    {{-- @include('frontend.pages.home.sections.course-section') --}}

    <!-- Offer Section -->
    {{-- @include('frontend.pages.home.sections.offer-section') --}}


    <!-- Instructor Section -->
    {{-- @include('frontend.pages.home.sections.instructor-section') --}}

    <!-- Video Section -->
    {{-- @include('frontend.pages.home.sections.video-section') --}}


    <!-- Brand Section -->
    {{-- @include('frontend.pages.home.sections.brand-section') --}}

    <!-- Quality Course Section -->
    {{-- @include('frontend.pages.home.sections.quality-course-section') --}}


    <!-- Testimonial Section -->
    {{-- @include('frontend.pages.home.sections.testimonial-section') --}}

    <!-- Blog Section -->
    {{-- @include('frontend.pages.home.sections.blog-section') --}}


    <!-- Footer -->
    {{-- @include('frontend.layouts.footer') --}}
@endsection
