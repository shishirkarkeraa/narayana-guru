<?php
require '../php/session.php'; 
require '../php/activity.php';
require '../php/checkadmin.php'; 
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: unauthorized.php");
    exit();
}

include '../php/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        if (!$stmt) {
            echo "Prepare statement error: " . $conn->error;
            exit();
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {

            $update_stmt = $conn->prepare("UPDATE users SET granted_access = 1 WHERE username = ?");
            $update_stmt->bind_param("s", $username);            
            if (!$update_stmt) {
                echo "Prepare statement error: " . $conn->error;
                exit();
            }
            if ($update_stmt->execute()) {
                echo "Access granted successfully for user: " . $username;
                header("Location: success.php?return_url=" . urlencode($_GET['return_url']));
                exit();
            } else {
                echo "Error granting access";
                exit();
            }
        } else {
            echo "User not found!";
        }
    } else {
        echo "Please provide a username";
    }
}
?>
<?php require '../php/adminheader.php'; ?>
        <div class="blankbord">
            <div class="blank">
                <div id="display-container">
                <h3>Grant Access</h3>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <label for="username">Enter Username to Grant Access:</label><br>
                        <input type="text" id="username" name="username" required><br><br>
                        <input id="grant" type="submit" value="Grant Access">
                    </form>
                </div>
            </div>
        </div>
<?php require '../php/footer.php'; ?>