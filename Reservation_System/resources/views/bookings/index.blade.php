@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading aos-init aos-animate" data-aos="fade-up">{{ __('Reservations Properties') }}</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200" class="aos-init aos-animate">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                {{ __('Reservations Properties') }}
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
                            <table class="table table-dark table-striped table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Property Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $booking->user_name }}</td>
                                            <td>{{ $booking->property_name }}</td>
                                            <td>{{ $booking->start_date }}</td>
                                            <td>{{ $booking->end_date }}</td>td>
                                            <td>{{ $booking->total_amount }}</td>
                                            <td>
                                                @if ($booking->statusbookings === 'under_review')
                                                    <span class="badge bg-warning">Under Review</span>
                                                @elseif ($booking->statusbookings === 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @elseif ($booking->statusbookings === 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @endif
                                            </td>
                                            <td >
                                                <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"  class="btn btn-success"><i class="bi bi-check-circle-fill"></i></button>
                                                </form>
                                                <form action="{{ route('bookings.rejected', $booking->id) }}" method="POST">
                                                    @csrf
                                                    @method('POST') <!-- استخدم POST هنا -->
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-x-circle-fill"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">There are no data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {!! $bookings->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
