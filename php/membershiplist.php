<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/adminheader.php'; ?> 
        <div class="displayborder">  
            <div class="displaybutton" id="displaybutton">
                <button class="filterButton" id="filter1" onclick="filterData('all')">ಎಲ್ಲಾ</button>
                <button class="filterButton" id="filter2" onclick="filterData('alive')">ಜೀವಂತ</button>
                <button class="filterButton" id="filter3" onclick="filterData('dead')">ಮೃತ</button>
                <button class="filterButton" id="filter4" onclick="filterData('permanent')">ಶಾಶ್ವತ</button>
                <button class="filterButton" id="filter5" onclick="filterData('yearly')">ವಾರ್ಷಿಕ</button>
            </div>
            <table id="membershipTable">
                
            </table>

            <script src="../javascript/filter.js"></script>
        </div>    
<?php require '../php/footer.php'; ?>