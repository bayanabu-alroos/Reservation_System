@extends('layouts.app')

@section('content')
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading aos-init aos-animate" data-aos="fade-up">{{ __('Edit  Property') }}</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200" class="aos-init aos-animate">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                {{ __('Edit  Property') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('properties.update', $property->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <input type="text" name="Propertyname"
                                        class="form-control @error('Propertyname') is-invalid @enderror" id="inputName"
                                        placeholder="Property Name" value="{{ $property->Propertyname }}">
                                    @error('Propertyname')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <input type="number" id="price_per_night" name="price_per_night"
                                        class="form-control @error('price_per_night') is-invalid @enderror"
                                        placeholder="Price/Night" value="{{ $property->price_per_night }}">
                                    @error('price_per_night')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <select id="status" name="status"
                                        class="form-control @error('status') is-invalid @enderror"
                                        aria-placeholder="Status">
                                        <option value="" disabled selected>Select Status Property</option>
                                        <option value="available" {{ $property->status == 'available' ? 'selected' : '' }}>
                                            Available</option>
                                        <option value="unavailable"
                                            {{ $property->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                    </select>
                                    @error('status')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <input type="file" name="image1"
                                        class="form-control @error('image1') is-invalid @enderror" id="inputImage"
                                        placeholder="Upload Image One" >
                                </div>
                                <div class="col-6 mb-3">
                                    <input type="file" name="image2"
                                        class="form-control @error('image2') is-invalid @enderror" id="inputImage"
                                        placeholder="Upload Image Two">
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea cols="30" rows="7" class="form-control @error('description') is-invalid @enderror"
                                        name="description" id="inputDescription" placeholder="Description">
                                        {{ old('description', $property->description) }}
                                    </textarea>
                                    @error('description')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="submit" value="Update Property" class="btn btn-primary">
                                    <a class="btn btn-danger btn-sm" href="{{ route('properties.index') }}"><i
                                            class="fa fa-arrow-left"></i>
                                        Back To All Properties</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
