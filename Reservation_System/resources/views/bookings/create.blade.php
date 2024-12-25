@extends('layouts.app')

@section('content')
    <div class="card mt-5">
        <h2 class="card-header">Add New Booking</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('bookings.index') }}"><i class="fa fa-arrow-left"></i>
                    Back</a>
            </div>

            <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- User Dropdown -->
                <div class="mb-3">
                    <label class="small mb-1" for="user_id"><strong>Select User:</strong></label>
                    <select name="user_id" class="form-control">
                        <option value="{{ Auth::user()->id }}" selected>{{ Auth::user()->name }}</option>
                    </select>
                </div>

                <!-- Property Dropdown -->
                <div class="mb-3">
                    <label class="small mb-1" for="property_id"><strong>Select Property:</strong></label>
                    <select name="property_id" class="form-control @error('property_id') is-invalid @enderror"
                        id="property_id">
                        <option value="" disabled selected>-- Select Property --</option>
                        @foreach ($properties as $property)
                            <option value="{{ $property->id }}">{{ $property->Propertyname }} -
                                ${{ $property->price_per_night }}/night</option>
                        @endforeach
                    </select>
                    @error('property_id')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Start Date -->
                <div class="mb-3">
                    <label for="start_date" class="form-label"><strong>Start Date:</strong></label>
                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                        id="start_date">
                    @error('start_date')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="mb-3">
                    <label for="end_date" class="form-label"><strong>End Date:</strong></label>
                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                        id="end_date">
                    @error('end_date')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </form>

        </div>
    </div>
@endsection
