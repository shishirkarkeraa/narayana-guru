<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ಬ್ರಹ್ಮಶ್ರೀ ನಾರಾಯಣ ಗುರು ಸಮಾಜ ಸೇವಾ ಸಂಘ </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Kannada:wght@100;200;300;400;500&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../css/styles.css">
        <script src="../javascript/index.js"></script>
        <script src="../javascript/limit.js"></script>
        <script src="../javascript/membership.js"></script>
        <link rel="icon" type="image/png" href="../images/assets/logo/title.png">
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
        <style>
            button {
            border: none;
            background: none;
            padding: 0;
            margin: 0;
            cursor: pointer;
            font-family: inherit;
            }
            @media screen and (min-width: 1024px) {
            button.menu__icon {
            display: none;
            width: 2rem;
            height: 2rem;
            padding: .25rem;
            position: relative;
            padding-left: 20px;
            }
            }
            @media only screen and (max-width: 767px) {
            button.menu__icon {
            display: block;
            width: 80px;
            height: 40px;
            padding: 5px;
            position: relative;
            border: 2px solid white;
            background-color: white;
            
            }
            }
            @media screen and (min-width: 768px) and (max-width: 1023px) {
            button.menu__icon {
            display: none;
            width: 30px;
            height: 2rem;
            padding: 12px;
            position: relative;
            }
            }

            
            button.menu__icon span {
            width: 1.5rem;
            height: 1.5rem;
            position: absolute;
            top: calc(.25rem - 1px);
            left: calc(.25rem - 1px);
            transition: transform .1806s cubic-bezier(.04,.04,.12,.96);
            align-self: center;
            }
            
            #animatedDiv {
            height: 0;
            overflow: hidden;
            white-space: nowrap;
            transition: height 1s ease-out;
            }

            .open {
            min-height: 180px; 
            }
        </style>
        <div class="maindiv">
            <div class="topnav">
                <div class="logoimg"><a href="index.php"><img type="image" class="logo" src="../images/assets/logo/logo.png "  alt="logo"></a></div>
                <div class="centerbar">
                    <div id="buttonbar" class="buttonbar">
                    <button class="menu__icon" id="triggerButton">ಮೆನು</button>
                        <ul id="menulist">
                            <li id="btn4"><a href="../php/index.php" >ಡ್ಯಾಶ್ಬೋರ್ಡ್</a></li>
                            <li id="btn1"><a href="../php/sangha.php" >ಸಂಘದ ಬಗ್ಗೆ</a></li>
                            <li id="btn2"><a href="../php/samiti.php"> ಸಮಿತಿ</a></li>
                            <li id="btn3"><a href="../php/gallery.php">ಗ್ಯಾಲರಿ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div  class="hiddenDiv" id="animatedDiv">
            <ul>
                <li id="btn4"><a href="../php/index.php" >ಡ್ಯಾಶ್ಬೋರ್ಡ್</a></li>
                <li id="btn1"><a href="../php/sangha.php" >ಸಂಘದ ಬಗ್ಗೆ</a></li>
                <li id="btn2"><a href="../php/samiti.php">ಸಮಿತಿ</a></li>
                <li id="btn3"><a href="../php/gallery.php">ಗ್ಯಾಲರಿ</a></li>
            </ul>

        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function() {
            $('#triggerButton').on('click', function() {
                var hiddenDiv = $('#animatedDiv');

                if (hiddenDiv.hasClass('open')) {
                hiddenDiv.removeClass('open');
                } else {
                hiddenDiv.addClass('open');
                }
            });
            });


        </script>
        <div class="loader-wrapper">
            <div class="loader"></div>
        </div>
