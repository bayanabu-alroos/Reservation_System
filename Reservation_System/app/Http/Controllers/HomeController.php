<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bookings = DB::table('bookings')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('properties', 'bookings.property_id', '=', 'properties.id')
            ->select(
                'bookings.*',
                'properties.Propertyname as property_name',
                'properties.price_per_night'
            )
            ->where('bookings.user_id', Auth::user()->id) // إضافة الشرط لتصفية الحجوزات حسب المستخدم
            ->latest()
            ->paginate(5);  // عرض 5 نتائج لكل صفحة

        return view('dashboard', compact('bookings'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // admin  Dashboard
    public function adminDashboard()
    {
        return view('admin_dashboard');
    }

    public function PropertyReservation($id)
    {
        $property = Property::find($id);
        return view('showproperty', compact('property'));
    }
}
