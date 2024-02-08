<?php 
include '../php/db_connection.php';
$sql = "SELECT date, name FROM bhajanelog WHERE date >= CURDATE() ORDER BY date LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $upcomingDate = $row['date'];                           

    if ($upcomingDate >= date('Y-m-d')) {
        echo "<div><h3 id='noticetitle'>ಮುಂಬರುವ ವಾರದ ಭಜನೆ:<br> $upcomingDate</h3>";
        echo "<p id='noticesubtitle'>ಭಜನಾ ಸೇವಾರ್ಥಿಗಳು:</p><ul>";
        
        $result = $conn->query("SELECT name FROM bhajanelog WHERE date = '$upcomingDate'");
        while ($row = $result->fetch_assoc()) {
            echo "<li id='noticename'>".$row['name']."</li>";
        }
        
        echo "</ul></div>";
    } else {
        echo "No upcoming dates found.";
    }
} else {
    echo "No upcoming dates found.";
}


$conn->close();
?>