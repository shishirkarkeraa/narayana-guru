<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/adminheader.php'; ?>
<?php include '../php/update_reports.php';?>
<?php include '../php/db_connection.php';?>
        <div class="ledgermain">
            <h2 id="ledgerh2">ಲೆಡ್ಜರ್ ರಿಪೋರ್ಟ್</h2>

                    <?php
                        $sqlRetrieveRecords = "SELECT tname, from_Date, to_Date FROM `records`";
                        $result = $conn->query($sqlRetrieveRecords);
                        if ($result->num_rows > 0) {
                            echo "<table id='report' border='1'>";
                            echo "<tr><th>ರಿಪೋರ್ಟ್</th><th>ದಿನಾಂಕದಿಂದ</th><th>ಇಲ್ಲಿಯವರೆಗೆ</th><th>ಕ್ರಿಯೆ</th></tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['tname'] . "</td>";
                                echo "<td>" . $row['from_Date'] . "</td>";
                                echo "<td>" . $row['to_Date'] . "</td>";
                                echo "<td><a id='action' href='view_record.php?tname=" . $row['tname'] . "'>ವೀಕ್ಷಿಸಿ  </a>";
                                echo " | <a id='action' href='delete_record.php?tname=" . $row['tname'] . "' onclick=\"return confirm('ಈ ದಾಖಲೆಯನ್ನು ಅಳಿಸಲು ನೀವು ಖಚಿತವಾಗಿ ಬಯಸುವಿರಾ?');\">  ಅಳಿಸಿ</a></td>"; 
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<div id='zeroresult'> ಯಾವುದೇ ವರದಿಯನ್ನು ರಚಿಸಲಾಗುತ್ತಿಲ್ಲ ! </div>";
                        }
                        
                        $conn->close();
                    ?>

        </div>
            
                        
<?php require '../php/footer.php'; ?>