<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/w3.css">
        <link rel="stylesheet" href="styles/styles.css">
        <style>
            .nbutton {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}

.nbutton2 {
    background-color: white; 
    color: black; 
    border: 2px solid #008CBA;
}

.nbutton2:hover {
    background-color: #008CBA; /* Cyan */
    color: white;
}


        </style>
        <title></title>
    </head>
    <body>
        <div>
            <img id="back" src="images/pic06.jpg" alt=""/>
            <div class="main">
                <a href="#"><button class="button" style="margin-bottom:20px;">Home</button></a>
                    <br>
                    <a href="test_yourself.php"><button class="button" style="margin-bottom:20px;">Test yourself</button></a>
                    <br>
                    <a href="about_us.php"><button class="button"style="margin-bottom:20px;">About us</button></a>
                    <br>
                <a href="contact_us.php"><button class="button" style="margin-bottom:20px;">Contact us</button></a>
            </div>
            <div class="main" style="margin-top:27%; margin-left: 30%;">
                <a href="login.php"><button class="nbutton nbutton2">Log In</button></a>
                <a href="register.php"><button class="nbutton nbutton2">Sign Up</button></a>
            </div>
        </div>
    </body>
</html>
