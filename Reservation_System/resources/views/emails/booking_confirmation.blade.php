<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <h1> Property Reservation Notification</h1>
    <p>Dear Site Manager's ,</p>
    <p>We are writing to inform you that a user has reserved a property. Below are the details of the reservation:</p>
    <p>Property Details: </p>
    <ul>
        <li>Property Name: {{ $booking->property->Propertyname }}</li>
    </ul>
    <p>Reservation Details:</p>
    <ul>
        <li>Reserved By: {{ $booking->user->name }}</li>
        <li>Reservation Period: From {{ $booking->start_date }} To {{ $booking->end_date }}</li>
        <li>Total Payment: ${{ $booking->total_amount }}</li>
    </ul>
    <p>Please review this reservation at your earliest convenience.</p>
    <p>If you require any additional information or assistance, do not hesitate to contact us.</p>
    <p>Best regards,</p>
    <p>{{ Auth::user()->name }}</p>
    <p>{{ Auth::user()->email }}</p>

</body>

</html>
