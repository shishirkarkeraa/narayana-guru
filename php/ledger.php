<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/adminheader.php'; ?>
        <div class="ledgermain">
            <h2 id="ledgerh2">ಲೆಡ್ಜರ್</h2>
            <table id="ledger">
                <thead>
                    <tr>
                        <th>ದಿನಾಂಕ</th>
                        <th>ಕಾರಣ</th>
                        <th>ಡೆಬಿಟ್/ಕ್ರೆಡಿಟ್</th>
                        <th>ಮೊತ್ತ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include '../php/db_connection.php';
                        $sql = "SELECT SUM(amount) AS total_amount FROM ledger";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $totalAmount = $row['total_amount'];
                        } else {
                            $totalAmount = 0;
                        }

                        $sql = "SELECT * FROM ledger";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $transactionType = $row['transactionType'];
                                $class = $transactionType === 'income' ? 'income' : 'expenditure';
                                if ($row["transactionType"]=="expenditure"){
                                    $tkan="ಡೆಬಿಟ್";
                                }
                                if ($row["transactionType"]=="income"){
                                    $tkan="ಕ್ರೆಡಿಟ್";
                                }
                                
                                if ($row["reason"]=="option1"){
                                    $kan="ವಿದ್ಯಾ ನಿಧಿ";
                                }
                                if ($row["reason"]=="option2"){
                                    $kan="ಆಜೇವ ಸದಸ್ಯತನ";
                                }
                                if ($row["reason"]=="option3"){
                                    $kan="ಗುರುಪೂಜೆ";
                                }
                                if ($row["reason"]=="option4"){
                                    $kan="ಸಹಾಯಧನ";
                                }
                                if ($row["reason"]=="option5"){
                                    $kan="ವಾರ್ಷಿಕೋತ್ಸವ / ಗುರುಜಯಂತಿ / ಭಜನಾಮಂಗಲೋತ್ಸವ";
                                }
                                if ($row["reason"]=="option6"){
                                    $kan="ಶಾಶ್ವತ ಪೂಜೆ";
                                }
                                if ($row["reason"]=="option7"){
                                    $kan="ಇತರ ಆದಾಯ";
                                }
                                if ($row["reason"]=="option8"){
                                    $kan="ಸಾಮಾನ್ಯ ಸದಸ್ಯತನ";
                                }
                                if ($row["reason"]=="option9"){
                                    $kan="ವಿದ್ಯಾರ್ಥಿ ವೇತನ";
                                }
                                if ($row["reason"]=="option10"){
                                    $kan="ಬ್ಯಾಂಕ್";
                                }
                                if ($row["reason"]=="option11"){
                                    $kan="ಕಾಣಿಕೆ ಡಬ್ಬಿ";
                                }
                                if ($row["reason"]=="option12"){
                                    $kan="ಬಡ್ಡಿ";
                                }
                                if ($row["reason"]=="option13"){
                                    $kan="ಡಿವಿಡೆಂಡ್";
                                }
                                if ($row["reason"]=="option14"){
                                    $kan="ಕಟ್ಟಡ ನಿರ್ವಹಣೆ";
                                }
                                if ($row["reason"]=="option15"){
                                    $kan="ಸಿಬ್ಬಂದಿ ವೇತನ";
                                }
                                if ($row["reason"]=="option16"){
                                    $kan="ವಿದ್ಯಾರ್ಥಿ ವೇತನ";
                                }
                                if ($row["reason"]=="option17"){
                                    $kan="ವಿದ್ಯುತ್ ಬಿಲ್";
                                }
                                if ($row["reason"]=="option18"){
                                    $kan="ವಿದ್ಯುತ್ ನಿರ್ವಹಣೆ";
                                }
                                if ($row["reason"]=="option19"){
                                    $kan="ಶುಚಿತ್ವ / ಕೂಲಿ";
                                }
                                if ($row["reason"]=="option20"){
                                    $kan="ಸಹಾಯಧನ/ಜಾಹಿರಾತು";
                                }
                                if ($row["reason"]=="option21"){
                                    $kan="ಪೀಠೋಪಕರಣ / ಖರೀದಿ / ಇತ್ಯಾದಿ ವಸ್ತು ಖರೀದಿ";
                                }
                                if ($row["reason"]=="option22"){
                                    $kan="ಮುದ್ರಣ/ಜೆರಾಕ್ಸ್ / ಟಪಾಲು / ಸ್ಟೇಷನರಿ";
                                }
                                if ($row["reason"]=="option23"){
                                    $kan="ದಿನಪತ್ರಿಕೆ / ಬಿಲ್";
                                }
                                if ($row["reason"]=="option24"){
                                    $kan="ಜನರೇಟರ್ ನಿರ್ವಹಣೆ";
                                }
                                if ($row["reason"]=="option25"){
                                    $kan="ಅಭಿನಂದನೆ / ಗೌರವ ಪುರಸ್ಕಾರ";
                                }
                                if ($row["reason"]=="option26"){
                                    $kan="ಲೆಕ್ಕ ಪರಿಶೋಧಕರ ವೆಚ್ಚು";
                                }
                                if ($row["reason"]=="option27"){
                                    $kan="ಪೂಜಾ ಸಾಮಗ್ರಿ";
                                }
                                if ($row["reason"]=="option28"){
                                    $kan="ವಾರ್ಷಿಕೋತ್ಸವ ಹಾಗು ಇನಿತ ಕಾರ್ಯಕ್ರಮ ಖರ್ಚು";
                                }
                                if ($row["reason"]=="option29"){
                                    $kan="ಕಟ್ಟಡ ತೆರಿಗೆ";
                                }
                                if ($row["reason"]=="option30"){
                                    $kan="ಮಹಾಸಭೆ ಖರ್ಚು";
                                }
                                if ($row["reason"]=="option31"){
                                    $kan="ಇತರ ಖರ್ಚು";
                                }

                                echo "<tr class='$class'>";
                                echo "<td>{$row['date']}</td>";
                                echo "<td>{$kan}</td>";
                                echo "<td>{$tkan}</td>";
                                echo "<td>{$row['amount']}</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
            <div class="sumamount">
                Total Amount: <?php echo $totalAmount; ?>
            </div>
        </div>
<?php require '../php/footer.php'; ?>