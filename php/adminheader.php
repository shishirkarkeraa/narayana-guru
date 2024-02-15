<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SYNC</title>
        <link rel="icon" type="image/png" href="../images/assets/logo/sync.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/desktop.css">
        <link rel="stylesheet" href="../css/mobile.css">
        <link rel="stylesheet" href="../css/tablet.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="../javascript/linker.js"></script>
        <script src="../javascript/restrict.js"></script>
        <script src="../javascript/index.js"></script>

        <style>
            body {
                background-image: url(../images/assets/background/image01.jpg);
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
        </style>
    </head>
    <body>
        <?php require '../php/checkadmin.php'; ?>
        <div class="maindiv">
            <div class="admintopnav">               
                <div class="logodiv">
                    <a href="../php/adminindex.php"><img type="image" class="logo2" src="../images/assets/logo/logo.png "  alt="logo"></a>
                </div>
                <div class="buttonbar2">
                <div class="dropdown">
                    <div class="dropdown-toggle" onclick="toggleDropdown()">
                        <div id="display-img2"> <img id="displayimg2" src="../images/account/<?php echo $_SESSION['username']; ?>.png"></div>
                        <div class="username"><?php echo $_SESSION['username']; ?></div>
                    </div>
                        <div class="dropdown-menu" id="myDropdown">
                            <a href="account.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/></svg> &nbsp;ಅಕೌಂಟ್ </a>                            
                            <?php
                            if ($isadmin==true) {
                                echo '<a href="admin.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16"><path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/></svg>&nbsp;ಅಡ್ಮಿನ್ </a>';
                            }
                            ?>
                            <a href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/><path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/></svg>&nbsp;&nbsp;ಲಾಗ್ ಔಟ್</a>
                        </div>
                    </div>
                </div>         
            </div>
        </div>
        <div class="loader-wrapper">
            <div class="loader"></div>
        </div>
        
