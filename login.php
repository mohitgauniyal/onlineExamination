<?php
$status = 0;
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $query = "select * from users where username='$username' and password='$password'";
    require_once 'includes/db.inc.php';
    $result = mysql_query($query);
    if (mysql_num_rows($result)==1) {
        $row = mysql_fetch_assoc($result);
        if ($row['verified'] == 'Y') {
            session_start();
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin')
                header('location:roles/admin/index.php');
            if ($row['role'] == 'student')
                header('location:roles/student/index.php');
        }
        else {
            $status = 1;
        }
    } else {
        $status = 2;
    }
}
?>

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
                background-color: #008CBA;
                color: white;
            }


        </style>
        <title></title>
    </head>
    <body>
        <nav>
            <?php require_once 'includes/guest/nav.inc.php'; ?>
        </nav>
        <section style="background-color:white;">
            <form action="login.php" method="POST" style="margin:20px;">
                Username : <input value="mohitgauniyal"placeholder="Username" name="username"class="w3-input w3-border w3-animate-input" type="text" style="width:30%">
                Password : <input value="123456"placeholder="Password" name="password" class="w3-input w3-border w3-animate-input" type="password" style="width:30%">
                <button class="nbutton nbutton2" name="submit">Login</button>
            </form>
            <?php if($status==1) {?>
            <h2 class="error">Go, First complete the verification.</h2>
            <?php } else if($status==2) { ?>
            <h2 class="error">Wrong username or password.</h2>
            <?php } ?>
            <hr>
            <a style="text-decoration:none;" href="forgot_password.php"><h5 style="color:pink;">Forgot password ?</h5></a>
        </section>
        <footer>
            <?php require_once 'includes/guest/footer.inc.php'; ?>
        </footer>
    </body>
</html>
