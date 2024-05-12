<!DOCTYPE html>
<html>
<head>
    <title>Reservation Confirmation</title>
</head>
<body>
    <h1>Reservation Confirmation</h1>
    <p>Thank you for your reservation, {{ $reservation->user->name }}.</p>
    <p>Reservation Details:</p>
    <ul>
        <li>Date: {{ $reservation->reservation_date }}</li>
        <li>Start Time: {{ $reservation->start_time }}</li>
        <li>End Time: {{ $reservation->end_time }}</li>
        <li>Room: {{ $reservation->room->name }}</li>
    </ul>
</body>
</html>
