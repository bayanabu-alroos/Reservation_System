@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading aos-init aos-animate" data-aos="fade-up">{{ __('Properties') }}</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200" class="aos-init aos-animate">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                {{ __('Properties') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container bootstrap snippets bootdey mt-5 mb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            @session('success')
                                <div class="alert alert-success" role="alert"> {{ $value }} </div>
                            @endsession

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary btn-sm" href="{{ route('properties.create') }}"> <i
                                        class="fa fa-plus"></i> Create New Property</a>
                            </div>

                            <table class="table table-dark table-striped table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th width="80px">#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price Per Night</th>
                                        <th>Status</th>
                                        <th width="250px">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($properties as $property)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><img src="/images/{{ $property->image1 }}" width="100px"></td>
                                            <td>{{ $property->Propertyname }}</td>
                                            <td>{{ $property->price_per_night }}</td>
                                            <td>
                                                @if ($property->status === 'available')
                                                    <span class="badge bg-success">{{ $property->status }}</span>
                                                @elseif ($property->status === 'unavailable')
                                                    <span class="badge bg-danger">{{ $property->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('properties.destroy', $property->id) }}"
                                                    method="POST">
                                                    {{-- <a class="btn btn-info btn-sm" --}}
                                                    {{-- href="{{ route('properties.show', $property->id) }}" --}}
                                                    {{-- style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"> --}}
                                                    {{-- <i class="bi bi-pencil-fill"></i> --}}
                                                    {{-- </a> --}}
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('properties.edit', $property->id) }}">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-eraser-fill"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">There are no data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>

                            {!! $properties->withQueryString()->links('pagination::bootstrap-5') !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
