<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/adminheader.php'; ?>
        <div class="bhajaneentry">
            <form id="bhajaneentry" action="processbhajane.php" method="post">
                <h3 id="bhajane">ಭಜನೆ ಎಂಟ್ರಿ</h3>
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required><br><br>
                
                <label for="bname">Name:</label>
                <input type="text" id="bname" name="name" required><br><br>
                
                <input id="bsubmit" type="submit" value="Submit">
            </form>
        </div>
        <?php
        include '../php/db_connection.php';
        $sql = "SELECT id, date, name FROM bhajanelog";
        $result = $conn->query($sql);
        ?>
        <div class="bm">
            <table id="dg">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Delete</th>
                </tr>

                <?php
                    // Display data in the table
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>".$row["id"]."</td>
                                    <td>".$row["date"]."</td>
                                    <td>".$row["name"]."</td>
                                    <td><a href='../php/deletebhajane.php?id=$row[id]' onclick=\"return confirm('ಈ ದಾಖಲೆಯನ್ನು ಅಳಿಸಲು ನೀವು ಖಚಿತವಾಗಿ ಬಯಸುವಿರಾ?');\">Delete</a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No records found</td></tr>";
                    }

                    $conn->close();
                ?>
            </table>
        </div>
<?php require '../php/footer.php'; ?>