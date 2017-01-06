<?php
require_once 'secure.inc.php';
$course = $_GET['course'];

if (isset($_POST['add'])) {
    $question_number = $_POST['question_number'];
    $question = $_POST['question'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $correct_answer = $_POST['correct_answer'];

    mysql_connect('localhost', 'root', '') or die("Can't connect to the server.");
    mysql_select_db('subjects') or die("Can't connect to the database.");

    $errors = array();
    $query = "select * from $course where question_number=$question_number";
    $result = mysql_query($query);

    if (mysql_num_rows($result)==1) {
        $errors['question_number'] = "Question number already exist";
    }

    $query = "select from $course where question='$question'";
    $result = mysql_query($query);

    if (count($errors) == 0) {
        if (@mysql_num_rows($result==1)) {
            $errors['question'] = "Question already exist";
        }
    }

    if (count($errors) == 0) {
        $query = "insert into $course values($question_number,'$question','$a','$b','$c','$d','$correct_answer')";
        mysql_query($query);
        header('Location:index.php?added=true');
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
        <style>
            .w3-container
            {
                margin:auto;
                width: 50%;
            }
            section
            {
                background-color: transparent;
            }
        </style> 
        <title></title>
    </head>
    <body>
        <nav>
            <?php require_once '../../includes/admin/nav.inc.php' ?>  
        </nav>
        <section>
            <form class="w3-container w3-card-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?course='.$course; ?>" method="POST">

                <h2 class="w3-text-blue">Add Question :</h2>
                <p>      
                    <label class="w3-text-blue"><b>Question Number</b></label>
                    <input class="w3-input w3-border" name="question_number" type="text">
                    <?php if (isset($errors['question_number'])) { ?>
                        <span>
                            <h2><?php echo $errors['question_number']; ?></h2>
                        </span>
                    <?php } ?>
                </p>

                <p>      
                    <label class="w3-text-blue"><b>Question</b></label>
                    <input class="w3-input w3-border" name="question" type="text">
                    <?php if (isset($errors['question'])) { ?>
                        <span>
                            <h2><?php echo $errors['question']; ?></h2>
                        </span>
                    <?php } ?>
                </p>

                <p>      
                    <label class="w3-text-blue"><b>Option A</b></label>
                    <input class="w3-input w3-border" name="a" type="text"></p>

                <p>      
                    <label class="w3-text-blue"><b>Option B</b></label>
                    <input class="w3-input w3-border" name="b" type="text"></p>

                <p>      
                    <label class="w3-text-blue"><b>Option C</b></label>
                    <input class="w3-input w3-border" name="c" type="text"></p>

                <p>      
                    <label class="w3-text-blue"><b>Option D</b></label>
                    <input class="w3-input w3-border" name="d" type="text"></p>

                <p>      
                    <label class="w3-text-blue"><b>Correct Option</b></label>
                    <input class="w3-input w3-border" name="correct_answer" type="text"></p>

                <p>      
                    <button class="w3-btn w3-blue" name="add">Add</button>
                    <input  class="w3-btn w3-blue" type="button" value="Cancel" onclick="history.go(-1)" />

                </p>

            </form>
        </section>
        <footer>
            <?php require_once '../../includes/admin/footer.inc.php'; ?>
        </footer>
    </body>
</html>
