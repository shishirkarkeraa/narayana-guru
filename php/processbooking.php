<?php
include '../php/db_connection.php';

$bookingDate = $_POST['bookingDate'];
$reason = $_POST['reason'];
$bookingFromTime = $_POST['bookingFromTime'];
$bookingToTime = $_POST['bookingToTime'];
$bookingName = $_POST['bookingName'];

$stmt = $conn->prepare("INSERT INTO hallbooking (bookingDate, reason, bookingFromTime, bookingToTime, bookingName) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $bookingDate, $reason, $bookingFromTime, $bookingToTime, $bookingName);

if ($stmt->execute()) {
    echo "Booking successful";
    header("Location: success.php?return_url=" . urlencode($_GET['return_url']));
    exit();
} else {
    echo "Error in booking";
}

$stmt->close();
$conn->close();
?>
