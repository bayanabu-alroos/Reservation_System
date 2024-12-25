<!DOCTYPE html>
<html>
<body>
    <h1>Update on Your Property Booking Request </h1>
    <p>Dear {{ $booking->user->name }},</p>
    <p>We are happy to let you know about the status of your property booking request. </p>
    <p>Dear {{ $booking->user->name }},</p>
    @if ($booking->statusbookings === 'approved')
        <p>booking has been approved, we encourage you to complete the necessary steps to confirm your reservation and
            prepare for your stay. Should you have any special requirements, feel free to reach out to us.</p>
    @endif
    @if ($booking->statusbookings === 'rejected')
        <p>
            booking has been rejected, we apologize for the inconvenience. You are welcome to explore our platform for
            other properties that may suit your needs.
        </p>
    @endif
    <p>Below are the details of your booking:</p>
    <ul>
        <li>Property Name: {{ $booking->property->Propertyname }}</li>
        <li>Booking Status: {{ $booking->statusbookings }}</li>
        <li>Check-In Date: {{ $booking->start_date }}</li>
        <li>Check-Out Date: {{ $booking->end_date }}</li>
        <li>Total Amount: {{ $booking->total_amount }}</li>
    </ul>
    <p>Thank you for choosing Property Website. We look forward to serving you.</p>
    <p>Best regards,</p>
    <p>{{ Auth::user()->name }}</p>
    <p>{{ Auth::user()->email }}</p>
</body>

</html>
