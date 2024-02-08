<?php require '../php/register_process.php'; ?>
<?php require '../php/loginheader.php'; ?>
        <div class="blankbord">
            <div class="blank">
                <div id="login-container">
                    <h2>Register</h2>
                    <form action="register.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="username" placeholder="Enter a username" required oninput="restrictInput(event)"><br>
                        <input type="password" name="password" placeholder="Enter a password" required oninput="restrictInput6(event)">
                        <input id="fileupload" type="file" name="profile_picture" accept="image/*"><br>
                        <input type="submit" value="Register">
                    </form>
                    <div id="error"> <?php if (isset($errorreg)) { ?><p id="error"><?php echo $errorreg; ?></p><?php } ?></div>
                    <div class="go-login"><button id="go-back" onclick="gotologin()">Go to Login Page</button></div>
                </div>
            </div>
        </div>
<?php require '../php/footer.php'; ?>