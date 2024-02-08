<?php
include '../php/db_connection.php';

$receiptNumber = isset($_GET['receiptnumber']) ? $_GET['receiptnumber'] : '';
$receiptNumber = filter_var($receiptNumber, FILTER_SANITIZE_STRING);
$sql = "DELETE FROM memberships WHERE receipt_number = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $receiptNumber);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Entry with receipt number $receiptNumber deleted successfully.";
            header("Location: success.php?return_url=" . urlencode($_GET['return_url']));
            exit();
        } else {
            echo "No entry found with receipt number $receiptNumber.";
        }
    } else {
        echo "Error executing the query: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
$conn->close();
?>
