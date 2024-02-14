<?php
include '../php/db_connection.php';

if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Fetch file information from the database
    $query = "SELECT filepath FROM datastore WHERE id = $fileId";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $file = $result->fetch_assoc();
        $filePath = $file['filepath'];

        // Delete the file from the folder
        if (unlink($filePath)) {
            // Delete the database entry
            $deleteQuery = "DELETE FROM datastore WHERE id = $fileId";
            $conn->query($deleteQuery);
            header('Location: success.php');
        }
    }
}

$conn->close();
exit();
?>
