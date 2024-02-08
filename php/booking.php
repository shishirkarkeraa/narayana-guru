<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/adminheader.php'; ?>
<?php require '../php/processmembership.php'; ?>
        <div class="hb">
            <div id="bookingFormContainer">
                <h2 style="font-weight: bold;">ಹಾಲ್ ಬುಕಿಂಗ್ ಎಂಟ್ರಿ</h2>
                <form action="../php/processbooking.php" method="post">
                    <label for="bookingName">ಬುಕಿಂಗ್ ಹೆಸರು:</label><br>
                    <input type="text" id="bookingName" name="bookingName" required><br><br>

                    <label for="bookingDate">ಬುಕಿಂಗ್ ದಿನಾಂಕ:</label><br>
                    <input type="date" id="bookingDate" name="bookingDate" required><br><br>

                    <label for="reason">ಕರಣ:</label><br>
                    <select id="reason" name="reason" required>
                        <option value="marital">ಮದುವೆ/ಆರತಕ್ಷತೆ/ನಿಶ್ಚಿತಾರ್ಥ</option>
                        <option value="lastrites">ಉತ್ತರಕ್ರಿಯೆ</option>
                        <option value="other">ಇತರ</option>
                    </select><br><br>
                    <label for="bookingFromTime">ಬುಕಿಂಗ್ ಸಮಯದಿಂದ:</label><br>
                    <input type="time" id="bookingFromTime" name="bookingFromTime" required><br><br>

                    <label for="bookingToTime">ಬುಕಿಂಗ್ ಸಮಯದ ವರೆಗೆ:</label><br>
                    <input type="time" id="bookingToTime" name="bookingToTime" required><br><br>


                    <div class="submitdiv"> <input type="submit" id="submit" value="ಬುಕ್ ಮಾಡು"></div>
                </form>

            </div>
            <?php
            include '../php/db_connection.php';
            $sql = "SELECT id, bookingDate, reason,bookingFromTime, bookingToTime, bookingName FROM hallbooking";
            $result = $conn->query($sql);
            ?>
            <div class="bm">
                <table id="dg">
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Reason</th>
                        <th>FromTime</th>
                        <th>ToTime</th>
                        <th>Delete</th>
                    </tr>

                    <?php
                        // Display data in the table
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                if ($row["reason"] === 'marital') {
                                    $ts = 'ಮದುವೆ/ಆರತಕ್ಷತೆ/ನಿಶ್ಚಿತಾರ್ಥ';
                                } else if ($row["reason"] === 'lastrites') {
                                    $ts = 'ಉತ್ತರಕ್ರಿಯೆ';
                                } else {
                                    $ts = 'ಇತರ';
                                }
                                echo "<tr>
                                        <td>".$row["id"]."</td>
                                        <td>".$row["bookingDate"]."</td>
                                        <td>".$row["bookingName"]."</td>
                                        <td>".$ts."</td>
                                        <td>".$row["bookingFromTime"]."</td>
                                        <td>".$row["bookingToTime"]."</td>
                                        <td><a href='../php/deletehb.php?id=$row[id]' onclick=\"return confirm('ಈ ದಾಖಲೆಯನ್ನು ಅಳಿಸಲು ನೀವು ಖಚಿತವಾಗಿ ಬಯಸುವಿರಾ?');\">Delete</a></td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No records found</td></tr>";
                        }

                        $conn->close();
                    ?>
                </table>
            </div>
        </div>
<?php require '../php/footer.php'; ?>t