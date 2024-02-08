<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/adminheader.php'; ?>
<?php require '../php/processmembership.php'; ?>
        <div class="membermain">
            <form id="membershipForm" action="../php/membership.php" method="post" enctype="multipart/form-data">
                <label for="name">ಹೆಸರು:</label><br>
                <input type="text" id="name" name="name" required oninput="restrictInput3(event)"><br><br>

                <label for="address">ಅಡ್ರೆಸ್:</label><br>
                <input type="text" id="address" name="address" required oninput="restrictInput4(event)"><br><br>

                <label for="status">ಸದಸ್ಯತ್ವ: ವಾರ್ಷಿಕ/ಶಾಶ್ವತ</label><br>
                <select id="status" name="status" onchange="handleStatusChange()" required>
                <option value="yearly" selected>ವಾರ್ಷಿಕ</option>
                <option value="permanent">ಶಾಶ್ವತ</option>
                </select><br><br>

                <label for="joinDate">ಸದಸ್ಯತ್ವದ ಸೇರುವ ದಿನಾಂಕ:</label><br>
                <input type="date" id="joinDate" name="joinDate" oninput="updateExpiryDate()" required><br><br>

                <label for="receiptNumber">ರಶೀದಿ ಸಂಖ್ಯೆ:</label><br>
                <input type="text" id="receiptNumber" name="receiptNumber"  oninput="restrictInput5()" required><br><br>

                <div id="expiryDateDiv">
                <label for="expiryDate">ಸದಸ್ಯತ್ವದ ಮುಕ್ತಾಯ ದಿನಾಂಕ:</label><br>
                <input type="text" id="expiryDate" name="expiryDate" readonly><br><br>
                </div>

                <div id="lifeStatus" style="display: none;">
                    <label for="lifeStatus">Life Status:</label>
                    <input type="text" id="lifeStatus" name="lifeStatus" value="alive" readonly><br><br>
                </div>

                <label for="photo">ಫೋಟೋ:</label><br>
                <input id="photoupload" type="file" name="photo" accept="image/*"><br>
                
                <div class="submitdiv"> <input type="submit" id="submit" value="Submit"></div>
                <div id="error" style="color: red;"></div>
                <div id="error"> <?php if (isset($errorregister)) { ?><p id="error"><?php echo $errorregister; ?></p><?php } ?></div>
            </form>

            <script src="../javascript/membership.js"></script>
        </div>
<?php require '../php/footer.php'; ?>