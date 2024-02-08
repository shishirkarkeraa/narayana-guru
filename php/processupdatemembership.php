<?php
include '../php/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiptNumber = $_POST['receiptnumber'];
    $updateType = $_POST['updateType'];

    if (!empty($receiptNumber)) {
        $checkQuery = "SELECT * FROM memberships WHERE receipt_number=?";
        $stmt_check = $conn->prepare($checkQuery);
        $stmt_check->bind_param("s", $receiptNumber);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            if (isset($_POST['receiptnumber'], $_POST['updateType'])) {
                $updateType = filter_var($_POST['updateType'], FILTER_SANITIZE_STRING);

                if ($updateType === "lifeStatus") {

                    $lifeStatus = filter_var($_POST['lifeStatus'], FILTER_SANITIZE_STRING);
                    $sql = "UPDATE memberships SET lifeStatus=? WHERE receipt_number=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $lifeStatus, $receiptNumber);

                    if ($stmt->execute()) {
                        echo "Life Status updated successfully";
                    } else {
                        echo "Error updating record: " . $stmt->error;
                    }
                } else if ($updateType === "membership") {
                    $membership = filter_var($_POST['membership'], FILTER_SANITIZE_STRING);
                    $upjoinDate = !empty($_POST['upjoinDate']) ? $_POST['upjoinDate'] : null;

                    if ($membership == "yearly") {
                        if ($upjoinDate !== null) {
                            $sql = "UPDATE memberships SET status=?, join_date=? WHERE receipt_number=?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sss", $membership, $upjoinDate, $receiptNumber);
                        } else {
                            $sql = "UPDATE memberships SET status=? WHERE receipt_number=?";
                            $stmt = $conn->prepare($sql);

                            $stmt->bind_param("ss", $membership, $receiptNumber);
                        }

                        if ($stmt->execute()) {
                            $sql = "UPDATE memberships SET expiry_date = DATE_ADD(join_date, INTERVAL 1 YEAR) WHERE receipt_number=?";
                            $stmt_expiry = $conn->prepare($sql);

                            $stmt_expiry->bind_param("s", $receiptNumber);

                            if ($stmt_expiry->execute()) {
                                echo "Membership updated successfully";
                                header("Location: success.php?return_url=" . urlencode($_GET['return_url']));
                                exit();
                            } else {
                                echo "Error updating record: " . $stmt_expiry->error;
                            }

                            $stmt_expiry->close();
                        } else {
                            echo "Error updating record: " . $stmt->error;
                        }
                    }
                }
            }
        } else {
            echo "Receipt number not provided or invalid";
        }

        $stmt_check->close();
    }
}

$conn->close();
?>
