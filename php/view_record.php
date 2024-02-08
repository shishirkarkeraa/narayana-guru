<?php
include 'db_connection.php';
$reasonsKannada = [
    "option1" => "ವಿದ್ಯಾ ನಿಧಿ",
    "option2" => "ಆಜೇವ ಸದಸ್ಯತನ",
    "option3" => "ಗುರುಪೂಜೆ",
    "option4" => "ಸಹಾಯಧನ",
    "option5" => "ವಾರ್ಷಿಕೋತ್ಸವ / ಗುರುಜಯಂತಿ / ಭಜನಾಮಂಗಲೋತ್ಸವ",
    "option6" => "ಶಾಶ್ವತ ಪೂಜೆ",
    "option7" => "ಇತರ ಆದಾಯ",
    "option8" => "ಸಾಮಾನ್ಯ ಸದಸ್ಯತನ",
    "option9" => "ವಿದ್ಯಾರ್ಥಿ ವೇತನ",
    "option10" => "ಬ್ಯಾಂಕ್",
    "option11" => "ಕಾಣಿಕೆ ಡಬ್ಬಿ",
    "option12" => "ಬಡ್ಡಿ",
    "option13" => "ಡಿವಿಡೆಂಡ್",
    "option14" => "ಕಟ್ಟಡ ನಿರ್ವಹಣೆ",
    "option15" => "ಸಿಬ್ಬಂದಿ ವೇತನ",
    "option16" => "ವಿದ್ಯಾರ್ಥಿ ವೇತನ",
    "option17" => "ವಿದ್ಯುತ್ ಬಿಲ್",
    "option18" => "ವಿದ್ಯುತ್ ನಿರ್ವಹಣೆ",
    "option19" => "ಶುಚಿತ್ವ / ಕೂಲಿ",
    "option20" => "ಸಹಾಯಧನ/ಜಾಹಿರಾತು",
    "option21" => "ಪೀಠೋಪಕರಣ / ಖರೀದಿ / ಇತ್ಯಾದಿ ವಸ್ತು ಖರೀದಿ",
    "option22" => "ಮುದ್ರಣ/ಜೆರಾಕ್ಸ್ / ಟಪಾಲು / ಸ್ಟೇಷನರಿ",
    "option23" => "ದಿನಪತ್ರಿಕೆ / ಬಿಲ್",
    "option24" => "ಜನರೇಟರ್ ನಿರ್ವಹಣೆ",
    "option25" => "ಅಭಿನಂದನೆ / ಗೌರವ ಪುರಸ್ಕಾರ",
    "option26" => "ಲೆಕ್ಕ ಪರಿಶೋಧಕರ ವೆಚ್ಚು",
    "option27" => "ಪೂಜಾ ಸಾಮಗ್ರಿ",
    "option28" => "ವಾರ್ಷಿಕೋತ್ಸವ ಹಾಗು ಇನಿತ ಕಾರ್ಯಕ್ರಮ ಖರ್ಚು",
    "option29" => "ಕಟ್ಟಡ ತೆರಿಗೆ",
    "option30" => "ಮಹಾಸಭೆ ಖರ್ಚು",
    "option31" => "ಇತರ ಖರ್ಚು"
];

if (isset($_GET['tname'])) {
    $selectedTname = $_GET['tname'];

    $sqlRetrieveDetails = "SELECT * FROM `$selectedTname`";
    $resultDetails = $conn->query($sqlRetrieveDetails);

    if ($resultDetails->num_rows > 0) {
        $table1Rows = [];
        $table2Rows = [];

        while ($rowDetails = $resultDetails->fetch_assoc()) {
            if (array_key_exists($rowDetails['reason'], array_slice($reasonsKannada, 0, 13))) {
                $table1Rows[] = $rowDetails;
            } else {
                $table2Rows[] = $rowDetails;
            }
        }

        require '../php/session.php';
        require '../php/activity.php';
        require '../php/adminheader.php';
        echo "<div class='ledgermain'>";
        echo "<h2 id='ledgerh2'>Details of $selectedTname (Table 1)</h2>";
        echo "<table id='ledger'>";
        createTable($table1Rows);
        echo "</table>";

        echo "<h2 id='ledgerh2'>Details of $selectedTname (Table 2)</h2>";
        echo "<table id='ledger'>";
        createTable($table2Rows);
        echo "</table>";
        echo "</div>";

    } else {
        echo "No details found for $selectedTname";
    }
} else {
    echo "No tname parameter found.";
}

$conn->close();

function createTable($rows) {
    global $reasonsKannada;
    $firstRow = true;
    $totalAmount = 0;
    foreach ($rows as $rowDetails) {
        if ($firstRow) {
            echo "<tr>";
            foreach ($rowDetails as $fieldName => $value) {
                if ($fieldName !== 'id') {
                    echo "<th>$fieldName</th>";
                }
            }
            echo "</tr>";
            $firstRow = false;
        }
        echo "<tr>";
        foreach ($rowDetails as $fieldName => $value) {
            if ($fieldName !== 'id') {
                if ($fieldName === 'reason') {

                    echo "<td>" . $reasonsKannada[$value] . "</td>";
                } else {
                    echo "<td>$value</td>";
                    if ($fieldName === 'total_amount') {
                        $totalAmount += $value;
                    }
                }
            }
        }
        echo "</tr>";
    }
    echo "<tr><td>Total</td><td>$totalAmount</td></tr>";
}
?>
