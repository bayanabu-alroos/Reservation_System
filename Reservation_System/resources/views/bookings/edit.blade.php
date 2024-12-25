@extends('layouts.app')

@section('content')
<div class="card mt-5">
  <h2 class="card-header"> Edit  bookings</h2>
  <div class="card-body">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('bookings.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- User (Readonly) -->
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select name="user_id" class="form-control" disabled >
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $booking->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Property (Readonly) -->
        <div class="mb-3">
            <label for="property_id" class="form-label">Property</label>
            <select name="property_id" class="form-control" disabled >
                @foreach ($properties as $property)
                    <option value="{{ $property->id }}" {{ old('property_id', $booking->property_id) == $property->id ? 'selected' : '' }}>
                        {{ $property->Propertyname }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Start Date (Readonly) -->
        <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" id="total_amount" name="total_amount" class="form-control" value="{{ $booking->total_amount }}" readonly>
        </div>

        <!-- End Date (Readonly) -->

        <!-- Start Date (Readonly) -->
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="n" id="start_date" name="start_date" class="form-control" value="{{ $booking->start_date }}" readonly>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $booking->end_date }}" readonly>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="statusbookings" class="form-label">Status</label>
            <select id="statusbookings" name="statusbookings" class="form-control">
                <option value="under_review" {{ $booking->statusbookings == 'under_review'}}>Under Review</option>
                <option value="approved" {{ $booking->statusbookings == 'approved'  }}>Approved</option>
                <option value="rejected" {{ $booking->statusbookings == 'rejected'  }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Booking</button>
    </form>

    </form>

  </div>
</div>
@endsection
