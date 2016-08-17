<?PHP
$status = 0;
$template = 1;

if (isset($_POST['search'])) {
    $username = $_POST['username'];
    require_once 'includes/db.inc.php';
    $query = "select * from users where username='$username'";
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 1) {
        $template = 2;
        $query = "select question from users where username='$username'";
        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);
        $question = $row['question'];
    } else {
        $template = 1;
        $status = 1;
    }
}


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $answer = sha1($answer);
    $query = "select * from users where username='$username' and answer='$answer'";
    require_once 'includes/db.inc.php';
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 1) {
        $template = 3;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = str_shuffle($str);
        $password = substr($str, 0, 8);
        $data = sha1($password);
        require_once './includes/db.inc.php';
        $query = "update users set password='$data' where username='$username'";
        mysql_query($query);
        $query = "select email from users where username='$username'";
        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);
        $email = $row['email'];
        /* require_once('includes/class.phpmailer.php');

          $mailer = new PHPMailer(true);

          $mailer->Sender = 'php.batch.2015@gmail.com';
          $mailer->SetFrom('php.batch.2015@gmail.com', 'Unisoft Dehradun');
          $mailer->AddAddress($email);
          $mailer->Subject = 'Password Reset';
          $mailer->MsgHTML('<p>Your Password is : '.$password.'</p>');

          // Set up our connection information.
          $mailer->IsSMTP();
          $mailer->SMTPAuth = true;
          $mailer->SMTPSecure = 'ssl';
          $mailer->Port = 465;
          $mailer->Host = 'smtp.gmail.com';
          $mailer->Username = 'php.batch.2015@gmail.com';
          $mailer->Password = 'abc#1234';

          $mailer->Send(); */
    } else {
        $template = 2;
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

        <title></title>
    </head>
    <body>
        <nav>
<?php require_once 'includes/guest/nav.inc.php'; ?>
        </nav>
        <section style="background-color:white;">
<?php if ($template == 1) { ?>
                <form style="margin-top:30px; padding:50px;"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input class="w3-input w3-animate-input" placeholder="Enter Username"type="text" name="username"style="width:30%">
                    <button style="margin-top:5px;"name="search">Search</button>
                </form>
    <?php if ($status == 1) { ?>
                    <h2 class="error">UserName is Incorrect</h2>
                <?php } ?>
            <?php } ?>
                    
                    
            <?php if ($template == 2) { ?>           
                <div >
                    <form  style="margin-top:30px; padding:50px;"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <input class="w3-input w3-animate-input" readonly name="username" value="<?php echo $username; ?>" style="width:30%">
                         <input class="w3-input w3-animate-input" readonly name="question" value="<?php echo $question; ?>" style="width:30%">                       
                        <input placeholder="Enter answer"type="text" name="answer" />
                        <button name="submit">Submit</button>
                    </form>
                </div>

    <?php if ($status == 2) { ?>
                    <h2 class="error">The given answer is Incorrect</h2>
                <?php } ?>
            <?php } ?>
                    
                    
            <?php if ($template == 3) { ?>
                <h3 class="success">Your password has been changed.</h3>
                <h3 class="success">Your Password has been sent to your email id '<?php echo $email; ?>'</h3>
                <h5><?php echo $password; ?></h5>
                <h4 class="success">Click <a href="login.php">here</a> to login.</h4>
<?php } ?>
        </section>
        <footer>
<?php require_once 'includes/guest/footer.inc.php'; ?>
        </footer>
    </body>
</html>
