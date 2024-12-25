<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Mail\BookingConfirmation;
use App\Mail\NewBookingNotification;
use Exception;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = DB::table('bookings')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('properties', 'bookings.property_id', '=', 'properties.id')
            ->select(
                'bookings.*',
                'users.name as user_name',
                'properties.Propertyname as property_name',
                'properties.price_per_night'
            )
            ->latest()
            ->paginate(5);  // Paginate with 5 results per page

        return view('bookings.index', compact('bookings'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users  = Auth::user();
        $properties = DB::table('properties')
            ->whereIn('status', ['available'])
            ->get();
        return view('bookings.create', compact('users', 'properties'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $user = Auth::user();
        $property = Property::findOrFail($request->property_id);

        // Validate the required fields
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'property_id' => 'required|exists:properties,id',
        ]);

        // Calculate the total amount
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $duration = $startDate->diffInDays($endDate);
        $totalAmount = $property->price_per_night * $duration;
        // Prepare the input data
        $input = [
            'user_id' => $user->id,
            'property_id' => $property->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_amount' => $totalAmount,
            'statusbookings' => 'under_review',
        ];

        // Create the booking
        //$booking = Booking::create($input);
        try {
            $booking = Booking::create($input);
        } catch (\Exception $e) {
            dd(vars: $e->getMessage());
        }
        // Send an email notification to the admin
        $adminEmail = 'bayan.adnan.alroos@gmail.com';  // Use the admin's actual email address

        Mail::to($adminEmail)->send(new BookingConfirmation($booking));

        return redirect()->route('showproperty', $property->id)
            ->with('success', 'Your request has been successfully submitted, and you will receive a response via email shortly.');
    }

    /**
     * Display the specified resource.
     */
    public function BookingConfirmation(Booking $booking)
    {
        $booking = DB::table('bookings')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('properties', 'bookings.property_id', '=', 'properties.id')
            ->select(
                'bookings.*',
                'users.name as user_name',
                'properties.Propertyname',
                'properties.price_per_night'
            )
            ->where('bookings.show', $booking)
            ->first(); // Fetch a single record

        if (!$booking) {
            abort(404, 'Booking not found');
        }

        return view('bookings.show', data: compact('booking'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $users = User::all();
        $properties = Property::all();

        return view('bookings.edit', compact('users', 'properties', 'booking'));
    }

    /**
     * Update the specified resource in storage.// approved
     */
    public function update(Request $request, $id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);
        $property = Property::where('id', $booking->property_id)->get()->first();  // Get the first property in the collection
        $user = User::where('id', $booking->user_id)->get()->first();  // Get the first user in the collection
        // Check if the status is 'under_review' before allowing updates (if necessary)
        if ($booking->statusbookings !== 'under_review') {
            return redirect()->route('bookings.index')
                ->withErrors(['error' => 'Only bookings with "under review" status can be updated.']);
        }
        // Update the booking with the new data
        $booking->statusbookings = 'approved'; // Set the status to "approved"
        // Save the updated booking
        try {
            $booking->save();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        // Send an email notification to the user (or admin)
        Mail::to($user->email)->send(new NewBookingNotification($booking));
        // Redirect back with success message
        return redirect()->route('bookings.index')
            ->with('success', 'An email has been sent to the property booker successfully');
    }

    /**
     * Update the specified resource in storage.// rejected
     */
    public function rejected(Request $request, $id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);
        $property = Property::where('id', $booking->property_id)->get()->first();  // Get the first property in the collec
        $user = User::where('id', $booking->user_id)->get()->first();  // Get the first user in the collection
        // Check if the status is 'under_review' before allowing updates (if necessary)
        if ($booking->statusbookings !== 'under_review') {
            return redirect()->route('bookings.index')
                ->withErrors(['error' => 'Only bookings with "under review" status can be updated.']);
        }
        // Update the booking with the new data
        $booking->statusbookings = 'rejected'; // Set the status to "approved"

        // Save the updated booking
        try {
            $booking->save();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        // Send an email notification to the user (or admin)
        Mail::to($user->email)->send(new NewBookingNotification($booking));
        // Redirect back with success message
        return redirect()->route('bookings.index')
            ->with('success', 'The booking has been rejected and the user has been notified.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
