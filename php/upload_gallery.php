<?php 
require '../php/session.php';
require '../php/activity.php'; 
require '../php/adminheader.php';
?>

<div class="gup">
    <div class="galleryhead">ಚಿತ್ರ ಅಪ್ಲೋಡ್ ಮಾಡಿ</div>
    <form action="uploadgallery.php" id="galleryupload" method="post" enctype="multipart/form-data">
        <label id="galleryupld" for="image">ಚಿತ್ರ ಆಯ್ಕೆ:</label><br>
        <input type="file" name="image" id="photoupload" accept="image/*" required><br>
        <div class="submitdiv"> <input id="submit" type="submit" name="submit" value="ಅಪ್ಲೋಡ್ ಮಾಡಿ"></button></div>
    </form>
</div>
<?php require '../php/display_gallery.php'; ?>

<?php require '../php/footer.php'; ?>
