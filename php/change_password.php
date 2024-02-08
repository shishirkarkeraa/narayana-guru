<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/change_password_process.php'; ?>
<?php require '../php/adminheader.php'; ?>
        <div class="blankbord">
            <div class="blank">
                <div id="login-container">
                    <h1 id="changepassword">Change Password</h1>
                    <form id="changepass" action="../php/change_password.php" method="post">                       
                        <input type="password" id="current_password" placeholder="Enter Current Password" name="current_password" required>                        
                        <input type="password" id="new_password" placeholder="Enter New Password" name="new_password" required>

                        <input type="password" id="confirm_password" placeholder="Confirm New Password" name="confirm_password" required>

                        <input type="submit" value="Change Password">
                    </form>
                    <div id="error"> <?php if (isset($error_message)) { echo '<p style="color: red;">' . $error_message . '</p>';}?></div>
                    <p id="login-status"></p>
                </div>
            </div>
        </div>
<?php require '../php/footer.php'; ?>