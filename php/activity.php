<?php
$inactive_timeout = 1800; 


if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $inactive_timeout) {
    $_SESSION = array();
    header("Location: ../php/logout.php");
    exit();
}

$_SESSION['last_activity'] = time();
?>
