<?php require '../php/loginsession.php'; ?>
<?php require '../php/loginheader.php'; ?>
    <div class="blankbord">
        <div class="blank">
            <div id="login-container">
                <img id="imgsuccess" src="../images/assets/require/success.png">
                <h3 id="success">ನಿಮ್ಮ ಕಾರ್ಯವನ್ನು ಕಾರ್ಯಗತಗೊಳಿಸಲಾಗಿದೆ</h3>
                <p id="successfull">2 ಸೆಕೆಂಡುಗಳ ನಿರೀಕ್ಷಿಸಿ</p>
            </div>
        </div>
    </div>
<?php require '../php/footer.php'; ?>

<script>
    var countdown = 1;

    function updateCountdown() {
        document.getElementById('successfull').innerText = countdown + ' ಸೆಕೆಂಡುಗಳ ನಿರೀಕ್ಷಿಸಿ';
        countdown--;

        if (countdown < 0) {
            var returnURL = "<?php echo isset($_GET['return_url']) ? $_GET['return_url'] : ''; ?>";
            window.location.href = returnURL || document.referrer || "/";
        } else {
            setTimeout(updateCountdown, 1000);
        }
    }

    setTimeout(updateCountdown, 1000);
</script>