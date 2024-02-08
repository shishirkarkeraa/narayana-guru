<?php
include '../php/db_connection.php';

if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Fetch file information from the database
    $query = "SELECT filename, filepath, filetype FROM datastore WHERE id = $fileId";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $file = $result->fetch_assoc();
        $filePath = $file['filepath'];
        $fileType = $file['filetype'];

        // Open the file in a new tab
        header('Content-Type: ' . mime_content_type($filePath)); // Detect content type dynamically
        header('Content-Disposition: inline; filename="' . $file['filename'] . '"');
        @readfile($filePath);
    }
}

// Close the database connection
$conn->close();
?>
