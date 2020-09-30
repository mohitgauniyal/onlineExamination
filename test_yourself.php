<?php
function make_name($name) {
    $new_name = ucfirst(str_replace('_', ' ', $name));
    return $new_name;
}
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/w3.css">
        <link rel="stylesheet" href="styles/styles.css">

        <title></title>

        <style>
            .button {
                border-radius: 4px;
                background-color: blueviolet;
                border: none;
                color: #FFFFFF;
                text-align: center;
                font-size: 28px;
                padding: 20px;
                width: 200px;
                transition: all 0.5s;
                cursor: pointer;
                margin: 5px;
            }

            .button span {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
            }

            .button span:after {
                content: '»';
                position: absolute;
                opacity: 0;
                top: 0;
                right: -20px;
                transition: 0.5s;
            }

            .button:hover span {
                padding-right: 25px;                
            }

            .button:hover span:after {
                opacity: 1;
                right: 0;
            }

        </style>
    </head>
    <body>
        <nav>
            <?php require_once 'includes/guest/nav.inc.php'; ?>
        </nav>
        <section style="background-color: transparent;">
            <img  style="float:right; margin: 15px;" src="images/A (122).jpg" height="200px" width="250px" alt="Logo img.">
            <p style="margin: 15px;">
                This is an Online examination portal for the students of Computer field. We have provided several MCQ's in different subjects through which you could improve your basic knowledge of these particular subjects, You'll be given fix time to answer question and after that time the answers will get automatically submited. This is a feature through which you can improve your time management abilities.
            </p>
            <p class="success">Do give us the feedback about the changes and improvements that you'd like to see in this Web Portal.</p>
            <h3 style="color:blueviolet;">Go and Test Yourselves&nbsp;-- </h3>
          </section>
        <footer>
            <?php require_once 'includes/guest/footer.inc.php'; ?>
        </footer>
    </body>
</html>
