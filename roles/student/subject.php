<?php
require_once 'secure.inc.php';
$subject = $_REQUEST['subject'];

mysql_connect('localhost', 'root', '') or die("Can\'t connect to server.");
mysql_select_db('subjects') or die('The database is not Available');

function make_name($name) {
    $new_name = ucfirst(str_replace('_', ' ', $name));
    //$new_name=  substr($new_name,0,strpos($new_name,'.'));
    return $new_name;
}

$subject_name = make_name($subject);

$template = 1;

$query = "select * from $subject";
$result = mysql_query($query);

if (isset($_POST['start'])) {
    $template = 2;
}


if (isset($_POST['submit'])) {
    $correct = 0;
    for ($i = 1; $i <= mysql_num_rows($result); $i++) {
        $question_number = $i;
        $answer = $_POST[$i];
        $query = "select * from $subject where question_number=$question_number and correct_answer='$answer'";
        $r = mysql_query($query);
        if (mysql_num_rows($r) > 0) {
            $correct++;
        } else {
            $qno[] = $question_number;
            $selected[] = $answer;
        }
    }
    $template = 3;

    mysql_close();
    mysql_connect('localhost', 'root', '') or die("Can\'t connect to server.");
    mysql_select_db('oes') or die('The database is not Available');
    $date = date('y-m-d', time());
    $time = date("h:i:s", time());
    $username = $_SESSION['username'];
    $subject = $_GET['subject'];
    $num_correct_ans = $correct;
    $num_qsn = ($i - 1);

    $query = "insert into history values('$date','$time','$username','$subject',$num_correct_ans,$num_qsn)";
    mysql_query($query);
    mysql_close();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../../styles/styles.css">
        <link rel="stylesheet" href="../../styles/w3.css">
        <script>
            
        </script>
        <style>
            input.accordion {
                background-color: #eee;
                color: #444;
                cursor: pointer;
                padding: 18px;
                width: 100%;
                border: none;
                text-align: left;
                outline: none;
                font-size: 15px;
                transition: 0.4s;
            }

            input.accordion.active, input.accordion:hover {
                background-color: #ddd;
            }

            input.accordion:after {
                content: '\02795';
                font-size: 13px;
                color: #777;
                float: right;
                margin-left: 5px;
            }

            input.accordion.active:after {
                content: "\2796";
            }

            div.panel {
                padding: 0 18px;
                background-color: white;
                max-height: 0;
                overflow: hidden;
                transition: 0.6s ease-in-out;
                opacity: 0;
            }

            div.panel.show {
                opacity: 1;
                max-height: 500px;  
            }
        </style>
        <title></title>
    </head>
    <body>
        <nav>
            <?php require_once '../../includes/student/nav.inc.php'; ?>
        </nav>
        <section style="background-color: white;">
            <?php if ($template == 1) { ?>
                <form action="subject.php?subject=<?php echo $subject ?>" method="POST">
                    <div style="margin-top:50px;"class="w3-container w3-pink">
                        <h2>Subject : <?php echo $subject_name; ?></h2>
                        <h3>Questions : <?php echo mysql_num_rows($result); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time&nbsp;:&nbsp;<?php echo mysql_num_rows($result); ?>&nbsp;min's</h3>

                        <button style="padding-left:10px;padding-right:10px;margin:10px;font-size: 20px;"name="start">Start</button>
                    </div>                    
                </form>
            <?php } ?>

            <?php if ($template == 2) { ?>
                <div style="margin-top:50px;">
                    <form action="subject.php?subject=<?php echo $subject ?>" method="POST">
                        <?php
                        for ($i = 1; $i <= mysql_num_rows($result); $i++) {
                            $row[$i] = mysql_fetch_assoc($result);
                            ?>
                            <input value="Question&nbsp;<?php echo $i; ?>&nbsp;&nbsp;&nbsp;&nbsp;+"class="accordion" >
                            <div class="panel">

                                <p><?php echo $row[$i]['question'] ?></p>

                                <p>a).<input type="radio" name="<?php echo $i; ?>" value="<?php echo $row[$i]['a'] ?>"><?php echo $row[$i]['a'] ?></p>
                                <p>b).<input type="radio" name="<?php echo $i; ?>" value="<?php echo $row[$i]['b'] ?>"><?php echo $row[$i]['b'] ?></p>
                                <p>c).<input type="radio" name="<?php echo $i; ?>" va lue="<?php echo $row[$i]['c'] ?>"><?php echo $row[$i]['c'] ?></p>
                                <p>d).<input type="radio" name="<?php echo $i; ?>" value="<?php echo $row[$i]['d'] ?>"><?php echo $row[$i]['d'] ?></p>

                            </div>

                        <?php } ?>
                        <button style="margin-top: 10px;"name="submit">Submit Answers</button>
                    </form>
                </div>
            <?php } ?>
            <?php if ($template == 3) { ?>
                <h1>You have given '<?php echo $correct; ?>'&nbsp; correct answers out of '<?php echo $question_number; ?>'.</h1>
                <h2 class="error">Wrong answers -- </h2>
                <?php
                //print_r($qno);
                //print_r($selected);

                mysql_connect('localhost', 'root', '') or die("Can\'t connect to server.");
                mysql_select_db('subjects') or die('The database is not Available');

                for ($i = 0; $i < count($qno); $i++) {
                    $query = "select * from $subject where question_number=$qno[$i]";
                    $result = mysql_query($query);
                    $row = mysql_fetch_assoc($result);
                    //print_r($row);
                    echo '<h3>Q).' . $row['question_number'] . '&nbsp' . $row['question'] . '</h3>';
                    echo 'You selected : ' . $selected[$i] . '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . 'Correct answer : ' . $row['correct_answer'];
                }
                ?>
            <?php } ?>
            <script>
                var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                    acc[i].onclick = function () {
                        this.classList.toggle("active");
                        this.nextElementSibling.classList.toggle("show");
                    }
                }
            </script>
        </section>
        <footer>
            <?php require_once '../../includes/student/footer.inc.php'; ?>
        </footer>
    </body>
</html>