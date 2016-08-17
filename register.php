<?php
function get_file_name($photo){
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = str_shuffle($str);
        $str = substr($str, 0,20);
        $i = strpos($photo, '.');
        $ext_name = substr($photo, $i);
        return $str.$ext_name;
    }

$status = 0;
$template = 1;

$name = '';
$username = '';
$email = '';
$gender = 'male';
$password = '';
$confirm_password = '';
$question = '';
$answer = '';
$photo = '';
$errors = array();

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $question = $_POST['question'];
    $answer =$_POST['answer'];

    $photo = $_FILES['photo']['name'];
    $photo_size = $_FILES['photo']['size'];
    $photo_type = $_FILES['photo']['type'];
    $temp_name = $_FILES['photo']['tmp_name'];

    if (empty($name)) {
        $errors['name'] = '*name required';
    }
    if (empty($username)) {
        $errors['username'] = '*username required';
    }
    if (empty($email)) {
        $errors['email'] = '*email required';
    }
    if (empty($password)) {
        $errors['password'] = '*password required';
        $errors['confirm_password'] = '* required';
    }
    if (empty($confirm_password)) {
        $errors['confirm_password'] = '* required';
        $errors['password'] = '*password required';
    }
    if (empty($question)) {
        $errors['question'] = '*question required';
    }
    if (empty($answer)) {
        $errors['answer'] = '*answer required';
    }
    if (empty($photo) || $photo_size > (1024 * 1024) || $photo_type != 'image/jpeg') {
        $errors['photo'] = '*photo required ( Format : jpg , Size < 1mb)';
    }

    if (count($errors) == 0) {

        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $errors['name'] = '* only letters and whitespaces are accetable';
        }
        if (!preg_match('/^[A-Za-z][A-Za-z0-9]*$/', $username)) {
            $errors['username'] = 'User Name is not Valid';
        }
        if (!preg_match('/^[A-Za-z0-9]+@[A-Za-z0-9]+\.[A-Za-z]+$/', $email)) {
            $errors['email'] = '* Email is not Valid';
        }
        if (strlen($password) < 6) {
            $errors['password'] = '* password can\'t be less then 6 cahracters';
            $errors['confirm_password'] = '* required';
        }
        if ($password != $confirm_password) {       
            $errors['password'] = '* required';
             $errors['confirm_password'] = '* password doesn\'t match.';
        }
    }

    if (count($errors) == 0) {
        $query = "select * from users where username='$username'";
        require_once './includes/db.inc.php';
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 1) {
            $errors['username'] = 'User Name already Exists';
        }
    }

    if (count($errors) == 0) {
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = str_shuffle($str);
        $verification_code = substr($str, 0, 25);
        $password = sha1($password);
        $answer = sha1($answer);

        $photo = get_file_name($photo);
        move_uploaded_file($temp_name, 'images/users/'.$photo);

        $query = "insert into users values('$name','$username','$password','student','$email','$gender','$photo','$question','$answer','$verification_code','N')";
        require_once './includes/db.inc.php';
        if(mysql_query($query))
        $template = 2;
    }

/*
    require_once('includes/class.phpmailer.php');

    $mailer = new PHPMailer(true);

    $mailer->Sender = '';
    $mailer->SetFrom('', '');
    $mailer->AddAddress($email);
    $mailer->Subject = 'Registration';
    $mailer->MsgHTML('<p>Registration Successful!</p>' .
            '<p>Verification Link <a href="http://x.com/verify.php?username=' . $username . '&code=' . $verification_code . '">Click here to verify</a></p>');

    // Set up our connection information.
    $mailer->IsSMTP();
    $mailer->SMTPAuth = true;
    $mailer->SMTPSecure = 'ssl';
    $mailer->Port = 465;
    $mailer->Host = 'smtp.gmail.com';
    $mailer->Username = '';
    $mailer->Password = '';

    $mailer->Send();*/
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
            .w3-input
            {
                width: 50%;
            }
        </style>
        <title></title>
    </head>
    <body>
        <nav>
            <?php require_once 'includes/guest/nav.inc.php'; ?>
        </nav>
        <section>
            <?php if ($template == 1) { ?>
                <div style="margin-top: 15px;" class="w3-container w3-brown">
                    <h2>Registration Form</h2>
                </div>
            <form style="margin: 20px;" action="register.php" method="POST" enctype="multipart/form-data">

                    <p>      
                        <label class="w3-label w3-text-pink"><b>Name</b></label>
                        <input class="w3-input w3-border w3-sand" name="name" type="text" value="<?php echo $name; ?>">
                        <?php if (isset($errors['name'])) { ?>
                        <span class="error"><?php echo $errors['name'] ?></span>
                        <?php } ?>
                    </p>

                    <p>      
                        <label class="w3-label w3-text-pink"><b>Username</b></label>
                        <input class="w3-input w3-border w3-sand" name="username" type="text" value="<?php echo $username; ?>">
                        <?php if (isset($errors['username'])) { ?>
                        <span class="error"><?php echo $errors['username'] ?></span>
                        <?php } ?>
                    </p>

                    
                    <p>      
                        <label class="w3-label w3-text-pink"><b>Password</b></label>
                        <input class="w3-input w3-border w3-sand" name="password" type="password">
                        <?php if (isset($errors['password'])) { ?>
                        <span class="error"><?php echo $errors['password'] ?></span>
                        <?php } ?>
                    </p>

                    <p>      
                        <label class="w3-label w3-text-pink"><b>Confirm Password</b></label>
                        <input class="w3-input w3-border w3-sand" name="confirm_password" type="password">
                        <?php if (isset($errors['confirm_password'])) { ?>
                        <span class="error"><?php echo $errors['confirm_password'] ?></span>
                        <?php } ?>
                    </p>
                    
                    <p>      
                        <label class="w3-label w3-text-pink"><b>Email</b></label>
                        <input class="w3-input w3-border w3-sand" name="email" type="text" value="<?php echo $email; ?>">
                        <?php if (isset($errors['email'])) { ?>
                        <span class="error"><?php echo $errors['email'] ?></span>
                        <?php } ?>
                    </p>

                    <input class="w3-radio" type="radio" name="gender" value="male" <?php if ($gender == 'male') echo "checked='checked'"; ?>>
                    <label class="w3-validate">Male</label>
                    <input class="w3-radio" type="radio" name="gender" value="female" <?php if ($gender == 'female') echo "checked='checked'"; ?>>
                    <label class="w3-validate">Female</label>

                    
                    <p>      
                        <label class="w3-label w3-text-pink"><b>Photo</b></label>
                        <input class="w3-input w3-border w3-sand" name="photo" type="file">
                        <?php if (isset($errors['photo'])) { ?>
                        <span class="error"><?php echo $errors['photo'] ?></span>
                        <?php } ?>
                    </p>
                    
                    <p>      
                        <label class="w3-label w3-text-pink"><b>Secret Question</b></label>
                        <input class="w3-input w3-border w3-sand" name="question" type="text" value="<?php echo $question; ?>">
                    <?php if (isset($errors['question'])) { ?>    
                    <span><?php echo $errors['question'] ?></span>
                    <?php } ?>
                    </p>
                    <p>      
                        <label class="w3-label w3-text-pink"><b>Answer</b></label>
                        <input class="w3-input w3-border w3-sand" name="answer" type="text"<?php echo $answer; ?>>
                        <?php if (isset($errors['answer'])) { ?>
                        <span class="error"><?php echo $errors['answer'] ?></span>
                        <?php } ?>
                    </p>
                    <p>
                        <button class="w3-btn w3-blue" name="register" type="submit">Register</button></p>

                </form>
            <?php }?>
            <?php if ($template == 2) { ?>
            <div style="margin:30px;">
            <h1 class="success">Registration almost complete..</h1>
                <h3 class="success">Verification link has been sent to your email account '<?php echo $email; ?>'</h3>
                <h3 class="success">Go to your email account to complete your verification</h3>
                </div>
            <?php } ?>
        </section>
        <footer>
            <?php require_once 'includes/guest/footer.inc.php'; ?>
        </footer>
    </body>
</html>
