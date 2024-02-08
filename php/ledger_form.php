<?php require '../php/session.php'; ?>
<?php require '../php/adminheader.php'; ?>
        <div class="ledgerentry">
            <form id="ledgerform" action="../php/process_ledger.php" method="post">
                <label for="date">ದಿನಾಂಕ:</label><br><br>
                <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required><br><br>

                <label for="transactionType">ಆದಾಯ/ವೆಚ್ಚ:</label><br>
                <div class="transactionType">
                    <label id="ttype">
                        <input id="ttypei" type="radio" name="transactionType"  value="income" onchange="showHideReasons('income')" required checked> 
                        ಆದಾಯ
                    </label>
                    <label id="ttype">
                        <input id="ttypei" type="radio" name="transactionType" value="expenditure" onchange="showHideReasons('expenditure')" required> 
                        ವೆಚ್ಚ
                    </label><br><br>
                </div>

                <label for="reason">ಕಾರಣ:</label><br><br>
                <select id="reason" name="reason">
                    <option value="none"></option>
                    <option value="option1">ವಿದ್ಯಾ ನಿಧಿ</option>
                    <option value="option3">ಗುರುಪೂಜೆ</option>
                    <option value="option4">ಸಹಾಯಧನ</option>
                    <option value="option5">ವಾರ್ಷಿಕೋತ್ಸವ / ಗುರುಜಯಂತಿ / ಭಜನಾಮಂಗಲೋತ್ಸವ </option>
                    <option value="option6">ಶಾಶ್ವತ ಪೂಜೆ</option>
                    <option value="option7">ಇತರ ಆದಾಯ</option>
                    <option value="option9">ವಿದ್ಯಾರ್ಥಿ ವೇತನ</option>
                    <option value="option10">ಬ್ಯಾಂಕ್</option>
                    <option value="option11">ಕಾಣಿಕೆ ಡಬ್ಬಿ</option>
                    <option value="option12">ಬಡ್ಡಿ</option>
                    <option value="option13">ಡಿವಿಡೆಂಡ್</option>
                    <option value="option14">ಕಟ್ಟಡ ನಿರ್ವಹಣೆ</option>
                    <option value="option15">ಸಿಬ್ಬಂದಿ ವೇತನ</option>
                    <option value="option16">ವಿದ್ಯಾರ್ಥಿ ವೇತನ</option>
                    <option value="option17">ವಿದ್ಯುತ್ ಬಿಲ್</option>
                    <option value="option18">ವಿದ್ಯುತ್ ನಿರ್ವಹಣೆ</option>
                    <option value="option19">ಶುಚಿತ್ವ / ಕೂಲಿ</option>
                    <option value="option20">ಸಹಾಯಧನ/ಜಾಹಿರಾತು</option>
                    <option value="option21">ಪೀಠೋಪಕರಣ / ಖರೀದಿ / ಇತ್ಯಾದಿ ವಸ್ತು ಖರೀದಿ</option>
                    <option value="option22">ಮುದ್ರಣ/ಜೆರಾಕ್ಸ್ / ಟಪಾಲು / ಸ್ಟೇಷನರಿ</option>
                    <option value="option23">ದಿನಪತ್ರಿಕೆ / ಬಿಲ್</option>
                    <option value="option24">ಜನರೇಟರ್ ನಿರ್ವಹಣೆ</option>
                    <option value="option25">ಅಭಿನಂದನೆ / ಗೌರವ ಪುರಸ್ಕಾರ</option>
                    <option value="option26">ಲೆಕ್ಕ ಪರಿಶೋಧಕರ ವೆಚ್ಚು</option>
                    <option value="option27">ಪೂಜಾ ಸಾಮಗ್ರಿ</option>
                    <option value="option28">ವಾರ್ಷಿಕೋತ್ಸವ ಹಾಗು ಇನಿತ ಕಾರ್ಯಕ್ರಮ ಖರ್ಚು</option>
                    <option value="option29">ಕಟ್ಟಡ ತೆರಿಗೆ</option>
                    <option value="option30">ಮಹಾಸಭೆ ಖರ್ಚು</option>
                    <option value="option31">ಇತರ ಖರ್ಚು</option>
                </select><br><br>
                

                <label for="amount">ಮೊತ್ತ:</label><br><br>
                <input type="number" id="amount" name="amount" required><br><br>

                <label for="receiptNumber">ರಶೀದಿ ಸಂಖ್ಯೆ/ವೋಚರ್ ಸಂಖ್ಯೆ:</label><br><br>
                <input type="text" id="receipt" name="receiptNumber"><br><br>

                <input type="submit" id="submit" value="Submit">
            </form>
            <script src="../javascript/restrict.js"></script>
            <script src="../javascript/ledger.js"></script>
        </div>
<?php require '../php/footer.php'; ?>