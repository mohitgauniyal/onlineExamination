<?php
require_once 'secure.inc.php';
$status = 0;
$template = 1;

if (isset($_POST['change_password'])) {

    $password = sha1($_POST['password']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $username = $_SESSION['username'];

        require_once '../../includes/db.inc.php';

        $query = "select * from users where username='$username' and password='$password'";

        $result = mysql_query($query);

        if (mysql_num_rows($result) == 1) {
            if ($new_password != $confirm_password) {
                $status = 1;
            } else {
                $new_password = sha1($new_password);
                $query = "update users set password='$new_password' where username='$username'";
                mysql_query($query);
                $template = 2;
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
        <link rel="stylesheet" href="../../styles/w3.css">
        <link rel="stylesheet" href="../../styles/styles.css">

        <title></title>
    </head>
    <body>
        <nav>
            <?php require_once '../../includes/student/nav.inc.php'; ?>
        </nav>
        <section style="background-color: white;">
            <?php if ($template == 1) { ?>
                <div style="margin-top:20px;">
                    <form style="margin:20px;"class="w3-container w3-card-4" method="POST"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                        <h2 class="w3-text-green">Password Reset</h2>

                        <p>      
                            <label class="w3-text-indigo"><b>Current password :</b></label>
                            <input class="w3-input w3-border" name="password" type="password"></p>

                        <p>      
                            <label class="w3-text-indigo"><b>New Password : </b></label>
                            <input class="w3-input w3-border" name="new_password" type="password">
                           
                        </p>

                        <p>      
                            <label class="w3-text-indigo"><b>Confirm Password : </b></label>
                            <input class="w3-input w3-border" name="confirm_password" type="password"></p>

                        <p>      
                            <button class="w3-btn w3-green" name="change_password">Change Password</button></p>

                    </form>
                </div>
                <?php if ($status == 1) { ?>
                    <h2 class="error">NEW and CONFIRM password don't match.</h2>
                <?php } ?>
                <?php if ($status == 2) { ?>
                    <h2 class="error">Wrong CURRENT password entered.</h2>
                <?php } ?>
            <?php } ?>

            <?php if ($template == 2) { ?>
                <h2 class="success">Password Successfully changed!</h2>
            <?php } ?>

        </section>
        <footer>
            <?php require_once '../../includes/student/footer.inc.php'; ?>
        </footer>
    </body>
</html>
