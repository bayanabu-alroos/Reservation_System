@extends('layouts.app')

@section('content')
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_3.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading aos-init aos-animate" data-aos="fade-up">
                        {{ $property->Propertyname }}
                    </h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200" class="aos-init aos-animate">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">
                                Properties
                            </li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                {{ $property->Propertyname }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="img-property-slide-wrap">
                        <div class="tns-outer" id="tns1-ow">
                            <div class="tns-nav" aria-label="Carousel Pagination"><button type="button" data-nav="0"
                                    aria-controls="tns1" style="" aria-label="Carousel Page 1" class=""
                                    tabindex="-1"></button><button type="button" data-nav="1" aria-controls="tns1"
                                    style="" aria-label="Carousel Page 2" class=""
                                    tabindex="-1"></button><button type="button" data-nav="2" aria-controls="tns1"
                                    style="" aria-label="Carousel Page 3 (Current Slide)"
                                    class="tns-nav-active"></button></div>
                            <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide
                                <span class="current">4</span> of 3
                            </div>
                            <div id="tns1-mw" class="tns-ovh">
                                <div class="tns-inner" id="tns1-iw">
                                    <div class="img-property-slide  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                                        id="tns1" style="transform: translate3d(-60%, 0px, 0px);"><img
                                            src="/images/{{ $property->image1 }}" alt="Image"
                                            class="img-fluid tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                        <img src="/images/{{ $property->image2 }}" alt="Image" class="img-fluid tns-item"
                                            id="tns1-item0" aria-hidden="true" tabindex="-1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h2 class="heading text-primary">{{ $property->Propertyname }}</h2>
                    <div class="price mb-2"><span>${{ $property->price_per_night }}</span>
                        <p class="text-black-50">
                            {{ $property->description }}
                        </p>
                        <div class="d-block agent-box p-5">
                            @session('success')
                                <div class="alert alert-success mb-4" role="alert"> {{ $value }} </div>
                            @endsession
                            <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- User Dropdown -->
                                <div class="mb-3 d-none">
                                    <label class="small mb-1" for="user_id"><strong>Select User:</strong></label>
                                    <select name="user_id" class="form-control">
                                        <option value="{{ Auth::user()->id }}" selected>{{ Auth::user()->name }}</option>
                                    </select>
                                </div>
                                <!-- Property Dropdown -->
                                <div class="mb-3 d-none">
                                    <input type="text" name="property_id" class="form-control"
                                        value="{{ $property->id }}" id="inputName" placeholder="Property Name">
                                </div>
                                <!-- Start Date -->
                                <div class="mb-3">
                                    <label for="start_date" class="form-label"><strong>Start Date:</strong></label>
                                    <input type="date" name="start_date"
                                        class="form-control @error('start_date') is-invalid @enderror" id="start_date">
                                    @error('start_date')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- End Date -->
                                <div class="mb-3">
                                    <label for="end_date" class="form-label"><strong>End Date:</strong></label>
                                    <input type="date" name="end_date"
                                        class="form-control @error('end_date') is-invalid @enderror" id="end_date">
                                    @error('end_date')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i>
                                    Reservation This Property</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
