<?php
include '../php/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_SESSION['username'], $_POST['name'], $_POST['address'], $_POST['status'], $_POST['joinDate'], $_POST['receiptNumber'], $_POST['lifeStatus'])
    ) {
        $loguser = $_SESSION['username'];
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
        $joinDate = $_POST['joinDate'];
        $receiptNumber = filter_var($_POST['receiptNumber'], FILTER_SANITIZE_STRING);
        $lifeStatus = filter_var($_POST['lifeStatus'], FILTER_SANITIZE_STRING);

        $expiryDate = null;
        if ($status === 'yearly' && isset($_POST['expiryDate'])) {
            $expiryDate = date("Y-m-d", strtotime($_POST['expiryDate']));
        }

        $stmt_check = $conn->prepare("SELECT COUNT(*) AS count FROM memberships WHERE receipt_number = ?");
        if ($stmt_check) {
            $stmt_check->bind_param("s", $receiptNumber);
            if ($stmt_check->execute()) {
                $result = $stmt_check->get_result();
                $row = $result->fetch_assoc();
                if ($row['count'] > 0) {
                    $errorregister = "Error: Receipt number already exists!";
                } else {
                    $stmt = $conn->prepare("INSERT INTO memberships (name, address, status, join_date, receipt_number, expiry_date, lifeStatus, user) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    if ($stmt) {
                        $stmt->bind_param("ssssssss", $name, $address, $status, $joinDate, $receiptNumber, $expiryDate, $lifeStatus, $loguser);
                        if ($stmt->execute()) {
                            if($status=="yearly"){
                                $reasontype = "option8";
                                $amount = 150;
                            }
                            if($status=="permanent"){
                                $reasontype = "option2";
                                $amount = 500;
                            }                           
                            $currentDate = date('Y-m-d');
                            $transactionType = "income";
                            $sql = "INSERT INTO ledger (date, reason, amount, user, transactionType, receiptNumber) VALUES (?, ?, ?, ?, ?,?)";
                            $stmt_ledger = $conn->prepare($sql);
                            if ($stmt_ledger) {
                                $stmt_ledger->bind_param("ssdsss", $currentDate, $reasontype, $amount, $loguser, $transactionType, $receiptNumber);
                                if ($stmt_ledger->execute()) {
                                    $targetDir = "../images/membership/";
                                    if (!empty($_FILES['photo']['tmp_name'])) {
                                        $targetFile = $targetDir . $receiptNumber . ".png";
                                        move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
                                    } else {
                                        $defaultImage = "../images/assets/require/default.png";
                                        $newDefaultImage = $targetDir . $receiptNumber . ".png";
                                        copy($defaultImage, $newDefaultImage);
                                    }
                                    $errorregister = "Membership Entry Successful";
                                    header("Location: success.php?return_url=" . urlencode($_GET['return_url']));
                                    exit();
                                } else {
                                    $errorregister = "Error: " . $stmt_ledger->error;
                                }
                                $stmt_ledger->close();
                            } else {
                                $errorregister = "Error preparing ledger query: " . $conn->error;
                            }
                        } else {
                            $errorregister = "Error executing membership insertion: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        $errorregister = "Error preparing membership insertion query: " . $conn->error;
                    }
                }
            } else {
                $errorregister = "Error executing receipt number check: " . $stmt_check->error;
            }
            $stmt_check->close();
        } else {
            $errorregister = "Error preparing receipt number check query: " . $conn->error;
        }

        $conn->close();
    } else {
        $errorregister = "Required POST parameters are not set.";
    }
}
?>
