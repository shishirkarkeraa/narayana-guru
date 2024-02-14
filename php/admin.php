<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/adminheader.php'; ?>
        <div class="blankbord">
            <div class="mainindex">
                <h3 id="welcome">ನಿರ್ವಾಹಕನಿಗೆ ಸ್ವಾಗತ</h3>
                <h2 id="welcome-address"> Welcome to admin console  <?php echo $_SESSION['username']; ?>!</h2>
                <div class="redirect">
                    <button class="dashboard" onclick="grantaccess()">ಅಧಿಕಾರ ನೀಡಿ</button>
                    <button class="dashboard" onclick="ledgerreportentry()"> ಲೆಡ್ಜೆರ್ ವರದಿ ರಚಿಸಿ</button>
                    <button class="dashboard" onclick="membershipentry()">ಮೆಂಬರ್ಶಿಪ್ ಎಂಟ್ರಿ</button>
                    <button class="dashboard" onclick="ledgerreportdisplay()">ಲೆಡ್ಜೆರ್ ವರದಿ</button>
                    <button class="dashboard" onclick="datastore()">ಡ್ರೈವ್</button>

                </div>
            </div>
        </div>
        <script src="../php/logout_on_close.js"></script>
<?php require '../php/footer.php'; ?>