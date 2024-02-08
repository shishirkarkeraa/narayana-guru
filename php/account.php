<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/adminheader.php'; ?>
        <div class="blankbord">
            <div class="blank">
                <div id="display-container">
                <div id="display-img"> <img id="displayimg" src="../images/account/<?php echo $_SESSION['username']; ?>.png"></div>
                <div id="dispuser"> Username : <?php echo $_SESSION['username']; ?> </div>
                <a id="account" href="change_password.php"><div id="changepass">Change Password</div></a>
                </div>
            </div>
        </div>
<?php require '../php/footer.php'; ?>