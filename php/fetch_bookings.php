<?php
include '../php/db_connection.php';

$date = $_GET['date'];


$sql = "SELECT bookingName, bookingDate, bookingFromTime, bookingToTime, reason FROM hallbooking WHERE bookingDate = '$date'";
$result = $conn->query($sql);

$bookings = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}


$conn->close();


echo json_encode($bookings);
?>
