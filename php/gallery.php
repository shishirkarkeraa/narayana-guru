<?php require '../php/header.php';
include '../php/db_connection.php';

$sql = "SELECT image_path FROM gallery";
$result = $conn->query($sql);
?>

<div class="blankbord">
    <div class="galleryhead">ಗ್ಯಾಲರಿ</div>
    <div class="galleryimg">
        <?php
        while ($row = $result->fetch_assoc()) {
            echo '<div class="image"><img id="gallery" src="../images/gallery/' . $row['image_path'] . '" alt="Gallery Image"></div>';
        }
        ?>
    </div>
</div>

<?php
require '../php/footer.php';
$conn->close();
?>
