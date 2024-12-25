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

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function SelectAllProperties()
    {
        $properties = Property::where('status', 'available')->get();
        return view('welcome', compact('properties'));
    }
}
