<?php
require '../php/loginheader.php';
session_start();
if (isset($_POST['refresh'])) {
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    // Redirect to logout.php
    header("Location: ../php/logout.php");
    exit();
}

if(isset($_SESSION['username'])) {
    include '../php/db_connection.php';
    $stmt = $conn->prepare("SELECT granted_access FROM users WHERE username = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result) {
        $row = $result->fetch_assoc();
        $grantedAccess = $row['granted_access'];
        if ($grantedAccess == 1) {
            header("Location: adminindex.php");
            exit();
        }
    }
    $stmt->close();
    $conn->close();
}
?>
        <div class="blankbord">
            <div class="blank">
                <div id="login-container">
                    <p id="edisplay">ನಿಮಗೆ ಅಧಿಕಾರ ನೀಡಲಾಗಿಲ್ಲ.  ದಯವಿಟ್ಟು ನಿರ್ವಾಹಕನನ್ನು ಸಂಪರ್ಕಿಸಿ</p>
                    <form method="post">
                    <button type="submit" name="refresh">Refresh</button>
                    </form><br>
                    
                    <!-- Logout Button -->
                    <form method="post">
                        <button type="submit" name="logout">Logout</button>
                    </form>
                </div>
            </div>
        </div>
<?php require '../php/footer.php'; ?>