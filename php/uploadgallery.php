<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    // File upload handling
    $uploadDir = '../images/gallery/';
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB

    $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedTypes) && $_FILES['image']['size'] <= $maxFileSize) {
        $uniqueId = generateUniqueID();
        include '../php/db_connection.php';

        while (isUniqueIdExists($conn, $uniqueId)) {
            $uniqueId = generateUniqueID();
        }

        $uniqueFilename = 'image_' . $uniqueId . '.' . $fileExtension;
        $uploadFile = $uploadDir . $uniqueFilename;
        $imagePath = $uniqueFilename;
        // Insert into the database with the unique id
        $sql = "INSERT INTO gallery (image_path, unique_id) VALUES ('$imagePath', '$uniqueId')";
        if ($conn->query($sql) === TRUE) {
            echo "ಚಿತ್ರ ಯಶಸ್ವಿಯಾಗಿ ಅಪ್ಲೋಡ್ ಮಾಡಲಾಗಿದೆ ಮತ್ತು ಡೇಟಾಬೇಸ್‌ಗೆ ಸೇರಿದೆ.";
        } else {
            echo "ಡೇಟಾಬೇಸ್ ಲೋಡ್ ಮಾಡಲು ವಿಫಲವಾಗಿದೆ: " . $conn->error;
        }
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);
        $conn->close();
        header("Location: success.php");
        exit();
        
    } else {
        echo "ದುರುಪಯೋಗದ ಪ್ರಯತ್ನ. ಆಪ್ಲೋಡ್ ಮಾಡಬಹುದಾದ ಚಿತ್ರ ಫಾರ್ಮೇಟ್ ಅನುಮತಿಸಲಾಗಿಲ್ಲ ಅಥವಾ ಚಿತ್ರ ಗಾತ್ರ ಹೆಚ್ಚಿದೆ.";
    }
}

// Function to generate a unique 4-digit identifier
function generateUniqueID() {
    return sprintf('%04d', rand(1, 9999));
}

// Function to check if a unique_id already exists in the database
function isUniqueIdExists($conn, $uniqueId) {
    $result = $conn->query("SELECT COUNT(*) FROM gallery WHERE unique_id = '$uniqueId'");
    $count = $result->fetch_row()[0];
    return $count > 0;
}
?>

