<?php

include '../php/db_connection.php';

// Fetch images data from the database
$sql = "SELECT * FROM gallery";
$result = $conn->query($sql);

// Handle delete button action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $idToDelete = $_POST['delete'];

    // Fetch file path from the database
    $fetchFilePathSql = "SELECT image_path FROM gallery WHERE id = '$idToDelete'";
    $filePathResult = $conn->query($fetchFilePathSql);

    if ($filePathResult->num_rows > 0) {
        $row = $filePathResult->fetch_assoc();
        $filePath = '../images/gallery/' . $row['image_path'];

        // Display confirmation dialog
        echo "<script>
                var userConfirmation = confirm('Are you sure you want to delete this image?');
                if (userConfirmation) {
                    window.location.href = 'display_gallery.php?delete=$idToDelete';
                }
             </script>";
    }
}

// If user confirms, proceed with deletion
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];

    // Fetch file path from the database
    $fetchFilePathSql = "SELECT image_path FROM gallery WHERE id = '$idToDelete'";
    $filePathResult = $conn->query($fetchFilePathSql);

    if ($filePathResult->num_rows > 0) {
        $row = $filePathResult->fetch_assoc();
        $filePath = '../images/gallery/' . $row['image_path'];

        // Delete file from the folder
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete record from the database
        $deleteSql = "DELETE FROM gallery WHERE id = '$idToDelete'";
        if ($conn->query($deleteSql) === TRUE) {
            echo "ಫೈಲ್ ಮತ್ತು ಡೇಟಾಬೇಸ್ ರಿಕಾರ್ಡ್ ಯಶಸ್ವಿಯಾಗಿ ಅಳಿಸಲಾಗಿದೆ.";
        } else {
            echo "ಅಳಿಸಲು ವಿಫಲವಾಗಿದೆ: " . $conn->error;
        }

        echo "<script>window.location.href = 'display_gallery.php';</script>";
    }
}

$conn->close();
?>

<!-- Display table of images -->
<div class="gup">
    <h2 class="galleryhead">ಗ್ಯಾಲರಿ</h2>
    <table id="dg" border="1">
        <tr>
            <th>ID</th>
            <th>File Path</th>
            <th>File Name</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['image_path']; ?></td>
                <td><?= $row['unique_id']; ?></td>
                <td id="gdp"><img id="dgup" src="../images/gallery/<?= $row['image_path']; ?>" alt="Image"></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="delete" value="<?= $row['id']; ?>">
                        <button id="deletegallery" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

