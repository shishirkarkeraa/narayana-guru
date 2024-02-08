<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/adminheader.php'; ?>
<?php require '../php/update_reports.php';?>
        <div class="ledgerentry">
            <h2>Ledger Report</h2>
            <form action="../php/process_ledger_report.php" method="post">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="fromDate">From Date:</label>
                <input type="date" id="date" name="fromDate" required><br><br>

                <label for="toDate">To Date:</label>
                <input type="date" id="date" name="toDate" required><br><br>

                <input type="submit" id="submit" value="Generate Report">
            </form>
        </div>
<?php require '../php/footer.php'; ?>