<?php require '../php/loginsession.php'; ?>
<?php if (isset($_SESSION) && !empty($_SESSION)) {
    header("Location: adminindex.php"); 
    exit();
} ?>
<?php require '../php/loginheader.php'; ?>
    <div class="blankbord">
        <div class="blank">
            <div id="login-container">
                <h2>Login</h2>
                <form id="login-form" action="login.php" method="POST" onsubmit="event.preventDefault(); checkUsername();">
                    <input type="text" name="username" id="username" placeholder="Username" required oninput="restrictInput(event)">
                    <button type="button" id="nextBtn" onclick="checkUsername()">Next</button>
                </form>
                <div id="error"> <?php if (isset($error)) { ?><p id="error"><?php echo $error; ?></p><?php } ?></div>
                <p id="login-status"></p>
                <div class="createaccount"><button id="newaccount" onclick="registerpage()">Create Account</button></div>
            </div>
            <script src="../javascript/key.js"></script>
        </div>
    </div>
<?php require '../php/footer.php'; ?>