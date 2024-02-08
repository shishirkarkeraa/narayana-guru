<?php
include '../php/db_connection.php';

if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Fetch file information from the database
    $query = "SELECT filename, filepath FROM datastore WHERE id = $fileId";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $file = $result->fetch_assoc();
        $filePath = $file['filepath'];

        // Trigger file download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file['filename'] . '"');
        header('Content-Length: ' . filesize($filePath));
        @readfile($filePath);
    }
}

// Close the database connection
$conn->close();
?>
