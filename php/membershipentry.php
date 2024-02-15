<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/adminheader.php'; ?>
<?php require '../php/processmembership.php'; ?>
        <div class="enmembermain">
            <form id="membershipForm" action="../php/membershipentry.php" method="post">
                <label for="memberName">ಹೆಸರು:</label><br>
                <input type="text" id="name" name="name" required oninput="restrictInput3(event)"><br><br>

                <label for="memberAddress">ಅಡ್ರೆಸ್:</label><br>
                <input type="text" id="address" name="address" required oninput="restrictInput4(event)"><br><br>

                <label for="membershipStatus">ಸದಸ್ಯತ್ವ: ವಾರ್ಷಿಕ/ಶಾಶ್ವತ</label><br>
                <select id="status" name="status" onchange="handleStatusChange()" required>
                    <option value="yearly" selected>ವಾರ್ಷಿಕ</option>
                    <option value="permanent">ಶಾಶ್ವತ</option>
                </select><br><br>

                <label for="lifeStatus">ಮೃತ/ಜೀವಂತ</label><br>
                <input type="radio" id="alive" name="lifeStatus" value="alive">
                <label for="alive">ಜೀವಂತ</label>
                <input type="radio" id="dead" name="lifeStatus" value="dead">
                <label for="dead">ಮೃತ</label><br><br>

                <label for="joinDate">ಸದಸ್ಯತ್ವದ ಸೇರುವ ದಿನಾಂಕ:</label><br>
                <input type="date" id="joinDate" name="joinDate" oninput="updateExpiryDate()" required><br><br>

                <label for="receiptNumber">ರಶೀದಿ ಸಂಖ್ಯೆ:</label><br>
                <input type="text" id="receiptNumber" name="receiptNumber" oninput="restrictInput5(event)" required><br><br>

                <div id="expiryDateDiv">
                    <label for="expiryDate">ಸದಸ್ಯತ್ವದ ಮುಕ್ತಾಯ ದಿನಾಂಕ:</label><br>
                    <input type="text" id="expiryDate" name="expiryDate" readonly><br><br>
                </div>

                <div class="submitdiv">
                    <input type="submit" id="submit" value="Submit">
                </div>
                <div id="error" style="color: red;"></div>
            </form>

            <script src="../javascript/membership.js"></script>
            <script src="../javascript/restrict.js"></script>
        </div>
<?php require '../php/footer.php'; ?>