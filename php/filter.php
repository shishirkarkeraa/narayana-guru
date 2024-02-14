<?php
include '../php/db_connection.php';

$option = $_GET['option'];

if ($option === 'all') {
    $sql = "SELECT * FROM memberships";
} elseif ($option === 'alive') {
    $sql = "SELECT name, address, status, join_date, expiry_date , receipt_number, lifeStatus FROM memberships WHERE lifeStatus = 'alive'";
} elseif ($option === 'dead') {
    $sql = "SELECT name, address, status, join_date, receipt_number, lifeStatus FROM memberships WHERE lifeStatus = 'dead' AND status='permanent' ";
} elseif ($option === 'permanent') {
    $sql = "SELECT name, address, status, join_date, receipt_number, lifeStatus FROM memberships WHERE status = 'permanent'";
} elseif ($option === 'yearly') {
    $sql = "SELECT name, address, status, join_date, receipt_number , expiry_date, lifeStatus FROM memberships WHERE status = 'yearly'";
} else {

    echo "Invalid option";
    exit();
}

$result = $conn->query($sql);
$rowCount = mysqli_num_rows($result);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ಫೋಟೋ</th><th>ಹೆಸರು </th><th>ಅಡ್ರೆಸ್ </th><th>ಪ್ರಕಾರ</th><th>ಸೇರುವ ದಿನಾಂಕ</th><th>ರಶೀದಿ ಸಂಖ್ಯೆ</th>";
    
    
    if ($option == 'alive' && $option !== 'dead') {
        echo "<th>ಮುಕ್ತಾಯ ದಿನಾಂಕ</th>";
    }
    if ($option !== 'yearly') {
        echo "<th>ಸ್ಥಿತಿ</th>";
    }

        echo "<th>ನವೀಕರಣ</th>";
    echo "</tr>";
    
    while ($row = $result->fetch_assoc()) {
        if ($row["status"]=="yearly"){
            $Skannada="ವಾರ್ಷಿಕ";
        }
        if ($row["status"]=="permanent"){
            $Skannada="ಅಜೀವ";
        }
        $imageUrl = "../images/membership/" . $row["receipt_number"] . ".png";
        
        echo "<tr>";
        echo "<td id='pptd'><div id='ppmember'><img id='membershipphoto' src='" . $imageUrl . "' alt='Member Image'></div></td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td >" . $row["address"] . "</td>";
        echo "<td>" . $Skannada . "</td>";
        echo "<td>" . $row["join_date"] . "</td>";
        echo "<td>" . $row["receipt_number"] . "</td>";

        if ($option == 'alive' && $option !== 'dead' ) {
            echo "<td>" . $row["expiry_date"] . "</td>";
        }
        if ($option !== 'yearly') {
            if ($row["lifeStatus"]=="alive"){
                $Lkannada="ಜೀವಂತ";
            }
            if ($row["lifeStatus"]=="dead"){
                $Lkannada="ಮೃತ";
            }
            echo "<td>" . $Lkannada . "</td>";
        }
            echo "<td><a href='../php/updatemembership.php?receiptnumber=$row[receipt_number]'>Update</a> | <a href='../php/processdeletemembership.php?receiptnumber=$row[receipt_number]' onclick=\"return confirm('ಈ ದಾಖಲೆಯನ್ನು ಅಳಿಸಲು ನೀವು ಖಚಿತವಾಗಿ ಬಯಸುವಿರಾ?');\">Delete</a></td>";

        echo "</tr>";
    }
    

    echo "</table>";
} else {

    echo "No results found";
}

$conn->close();
?>

<!-- Add this script at the end of filter.php -->
<script>
    function redirectToUpdate(receiptNumber) {
        window.location.href = 'updatemembership.php?receiptnumber=' + receiptNumber;
    }

    <?php require '../php/deletemembership.php'; ?>

    function deleteEntry(receiptNumber) {
        if (confirm('Are you sure you want to delete this entry?')) {
            document.getElementById('receiptnumber').value = receiptNumber;
            document.getElementById('dltmbr').submit(); // Submit the form with receiptnumber
        }
    }
</script>
