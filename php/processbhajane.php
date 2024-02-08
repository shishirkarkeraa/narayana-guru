<?php
include '../php/db_connection.php';

if (isset($_POST['date'], $_POST['name'])) {
    $date = $_POST['date'];
    $name = $_POST['name'];

    $sql = "INSERT INTO bhajanelog (date, name) VALUES (?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $date, $name);

        if ($stmt->execute()) {
            echo "New record created successfully";
            header("Location: success.php?return_url=" . urlencode($_GET['return_url']));
            exit();
        } else {
            echo "Error executing the query: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Required POST parameters are not set";
}

$conn->close();
?>
