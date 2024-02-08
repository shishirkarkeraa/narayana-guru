<?php
session_start();
if (isset($_POST['date'], $_POST['reason'], $_POST['amount'], $_POST['transactionType'], $_POST['receiptNumber'])) {
    $date = htmlspecialchars($_POST['date']);
    $reason = htmlspecialchars($_POST['reason']);
    $amount = floatval($_POST['amount']);
    $loguser = $_SESSION['username'];
    $transactionType = $_POST['transactionType'];
    $receiptNumber = $_POST['receiptNumber'];
    include '../php/db_connection.php';
    $checkExistingReceipt = $conn->prepare("SELECT receiptNumber FROM ledger WHERE receiptNumber = ?");
    $checkExistingReceipt->bind_param("s", $receiptNumber);
    $checkExistingReceipt->execute();
    $checkExistingReceipt->store_result();    
    if ($checkExistingReceipt->num_rows > 0) {
        echo "Error: Receipt number already exists in the ledger table.";
    } else {
        $checkExistingReceipt->close();
        if ($transactionType === 'expenditure' && $amount > 0) {
            $amount = -$amount;
        } else {
            $amount = +$amount;
        }
        $sql = "INSERT INTO ledger (date, reason, amount, user, transactionType, receiptNumber) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsss", $date, $reason, $amount, $loguser, $transactionType, $receiptNumber);

        if ($stmt->execute()) {
            echo "New record created successfully";
            header("Location: success.php?return_url=" . urlencode($_GET['return_url']));
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
} else {
    echo "Error: Missing or empty fields in the form data.";
}
?>
