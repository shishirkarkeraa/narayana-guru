<?php require '../php/session.php';
require '../php/adminheader.php'; 
$receiptNumber = isset($_GET['receiptnumber']) ? $_GET['receiptnumber'] : '';
?>
        <div class="updatemain">
                <div class="changediv">
                        <h2 id="modify">ನವೀಕರಣ ಎಂಟ್ರಿ</h2>
                        <form action="processupdatemembership.php" method="POST">
                                <label for="receiptnumber">ರಶೀದಿ ಸಂಖ್ಯೆ:</label><br>
                                <input type="text" id="receiptnumber" name="receiptnumber" value="<?php echo  ($receiptNumber); ?>" required oninput="restrictInput5(event)"><br><br>

                                <label for="updateType">ನವೀಕರಣ ಪ್ರಕಾರ:</label><br>
                                <select id="updateType" name="updateType" onchange="toggleFields()">
                                <option value="lifeStatus" selected>ಮೃತ/ಜೀವಂತ</option>
                                <option value="membership">ಸದಸ್ಯತನ </option>
                                <option value="upname">ಹೆಸರು </option>
                                <option value="upaddress">ಅಡ್ರೆಸ್ </option>
                                <option value="upjoinDate">ಸೇರುವ ದಿನಾಂಕ</option>
                                <option value="photo">ಫೋಟೋ</option>
                                </select><br><br>
                                
                                <div id="lifeStatus">                    
                                        <label class="alive"  for="alive">ಜೀವಿಕ</label>
                                        <input type="radio" id="alive" name="lifeStatus" value="alive">
                                        <label class="dead" for="dead">ಮೃತ </label>
                                        <input type="radio" id="dead" name="lifeStatus" value="dead">                    
                                </div>
                                
                                <input type="text" id="upname" name="upname" placeholder="Enter the name to be updated" oninput="restrictInput3(event)" >
                                
                                <input type="text" id="upaddress" name="upaddress" placeholder="Enter the address to be updated" oninput="restrictInput4(event)">
                                
                                <select id="membership" name="membership" onchange="handleStatusChange()" >
                                <option value="yearly" selected>Yearly Membership</option>
                                <option value="permanent">Permanent</option>
                                </select>

                                <input type="date" id="upjoinDate" name="upjoinDate" oninput="updateExpiryDate()" >

                                <input type="text" id="expiryDate" name="expiryDate" placeholder="Membership expiry will update here" readonly >
                                <label for="photo">ಫೋಟೋ:</label><br>
                                <input id="photo" type="file" name="photo" accept="image/*"><br>
                                

                                <input id="update" type="submit" value="Update">
                        </form> 
                        <script src="../javascript/updatemembership.js"></script>
                </div>
        </div>
        
<?php require 'footer.php'; ?>