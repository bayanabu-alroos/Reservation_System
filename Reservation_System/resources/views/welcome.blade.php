@extends('layouts.app')
@section('content')
    <div class="hero">
        <div class="tns-outer" id="tns1-ow">
            <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span
                    class="current">3</span> of 3</div>
            <div id="tns1-mw" class="tns-ovh">
                <div class="tns-inner" id="tns1-iw">
                    <div class="hero-slide  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" id="tns1"
                        style="transform: translate3d(-40%, 0px, 0px);">
                        <div class="img overlay tns-item tns-slide-cloned"
                            style="background-image: url('images/hero_bg_1.jpg')" aria-hidden="true" tabindex="-1"></div>
                        <div class="img overlay tns-item" style="background-image: url('images/hero_bg_3.jpg')"
                            id="tns1-item0" aria-hidden="true" tabindex="-1"></div>
                        <div class="img overlay tns-item tns-slide-active"
                            style="background-image: url('images/hero_bg_2.jpg')" id="tns1-item1"></div>
                        <div class="img overlay tns-item" style="background-image: url('images/hero_bg_1.jpg')"
                            id="tns1-item2" aria-hidden="true" tabindex="-1"></div>
                        <div class="img overlay tns-item tns-slide-cloned"
                            style="background-image: url('images/hero_bg_3.jpg')" aria-hidden="true" tabindex="-1"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center">
                    <h1 class="heading aos-init aos-animate" data-aos="fade-up">
                        Easiest way to find your dream home
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="font-weight-bold text-primary heading">
                        Popular Properties
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="property-slider-wrap">
                        <div class="tns-outer" id="tns2-ow">
                            <div class="tns-nav" aria-label="Carousel Pagination"><button type="button" data-nav="0"
                                    aria-controls="tns2" style="" aria-label="Carousel Page 1" class=""
                                    tabindex="-1"></button><button type="button" data-nav="1" aria-controls="tns2"
                                    style="" aria-label="Carousel Page 2" class=""
                                    tabindex="-1"></button><button type="button" data-nav="2" aria-controls="tns2"
                                    style="" aria-label="Carousel Page 3 (Current Slide)"
                                    class="tns-nav-active"></button><button type="button" data-nav="3" tabindex="-1"
                                    aria-controls="tns2" style="display:none" aria-label="Carousel Page 4"></button><button
                                    type="button" data-nav="4" tabindex="-1" aria-controls="tns2" style="display:none"
                                    aria-label="Carousel Page 5"></button><button type="button" data-nav="5"
                                    tabindex="-1" aria-controls="tns2" style="display:none"
                                    aria-label="Carousel Page 6"></button><button type="button" data-nav="6"
                                    tabindex="-1" aria-controls="tns2" style="display:none"
                                    aria-label="Carousel Page 7"></button><button type="button" data-nav="7"
                                    tabindex="-1" aria-controls="tns2" style="display:none"
                                    aria-label="Carousel Page 8"></button><button type="button" data-nav="8"
                                    tabindex="-1" aria-controls="tns2" style="display:none"
                                    aria-label="Carousel Page 9"></button></div>
                            <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide
                                <span class="current">12 to 14</span> of 9
                            </div>
                            <div id="tns2-mw" class="tns-ovh">
                                <div class="tns-inner" id="tns2-iw">
                                    <div class="property-slider  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                                        id="tns2" style="transform: translate3d(-73.3333%, 0px, 0px);">
                                        @foreach ($properties as $property)
                                            <div class="property-item tns-item tns-slide-cloned" aria-hidden="true"
                                                tabindex="-1">
                                                <a href="property-single.html" class="img">
                                                    <img src="/images/{{ $property->image1 }}" alt="Image"
                                                        class="img-fluid">
                                                </a>
                                                <div class="property-content">
                                                    <div class="price mb-2"><span>${{ $property->price_per_night }}</span>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="city d-block mb-3">{{ $property->Propertyname }}</span>
                                                        <span
                                                            class="d-block mb-2 text-black-50">{{ $property->description }}</span>
                                                            <a href="{{ route('showproperty', $property->id) }}"
                                                            class="btn btn-primary py-2 px-3">Property Reservation</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
                        <span class="prev" data-controls="prev" aria-controls="tns2" tabindex="-1">Prev</span>
                        <span class="next" data-controls="next" aria-controls="tns2" tabindex="-1">Next</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
