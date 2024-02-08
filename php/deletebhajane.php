<?php
include '../php/db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$sql = "DELETE FROM bhajanelog WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Entry with Id $id deleted successfully.";
            header("Location: success.php?return_url=" . urlencode($_GET['return_url']));
            exit();
        } else {
            echo "No entry found with id $id.";
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
