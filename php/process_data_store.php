<?php

include '../php/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDirectory = '../data_store/';
    $fileTypes = ['pdf', 'doc', 'xls', 'txt', 'jpg', 'png', 'ppt', 'mp4', 'mp3'];

    try {
        // Use the existing database connection
        $db = $conn; // Replace with the function from db_connection.php

        foreach ($_FILES['files']['name'] as $key => $fileName) {
            $filePath = $targetDirectory . $fileName;
            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            if (in_array($fileType, $fileTypes) && $_FILES['files']['size'][$key] <= 500000000) {
                if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $filePath)) {
                    // Save to the database using prepared statements
                    $query = $db->prepare('INSERT INTO datastore (filepath, filename, filetype) VALUES (?, ?, ?)');
                    $query->execute([$filePath, $fileName, $fileType]);
                } else {
                    throw new Exception('File upload failed.');
                }
            } else {
                throw new Exception('Invalid file type or size exceeded.');
            }
        }

        // Redirect to success page after successful upload
        header('Location: success.php');
        exit();
    } catch (Exception $e) {
        // Handle exceptions and display an error message
        echo 'Error: ' . $e->getMessage();
    }
}
?>
