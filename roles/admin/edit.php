<?php
require_once 'secure.inc.php';
mysql_connect('localhost', 'root', '') or die("Can't connect to the server.");
mysql_select_db('subjects') or die("Can't connect to the database.");
$course = $_GET['course'];
$question_number = $_GET['question_number'];
$query = "select * from $course where question_number=$question_number";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);
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
            <form class="w3-container w3-card-4" action="update.php?course=<?php echo $course?>" method="POST">

            <h2 class="w3-text-blue">Edit Question :</h2>
            <p>      
                <label class="w3-text-blue"><b>Question Number</b></label>
                <input class="w3-input w3-border" name="question_number" type="text" readonly value="<?php echo $row['question_number'] ?>"></p>

            <p>      
                <label class="w3-text-blue"><b>Question</b></label>
                <input class="w3-input w3-border" name="question" type="text"value="<?php echo $row['question'] ?>"></p>

            <p>      
                <label class="w3-text-blue"><b>Option A</b></label>
                <input class="w3-input w3-border" name="a" type="text"value="<?php echo $row['a'] ?>"></p>

            <p>      
                <label class="w3-text-blue"><b>Option B</b></label>
                <input class="w3-input w3-border" name="b" type="text"value="<?php echo $row['b'] ?>"></p>

            <p>      
                <label class="w3-text-blue"><b>Option C</b></label>
                <input class="w3-input w3-border" name="c" type="text"value="<?php echo $row['c'] ?>"></p>

            <p>      
                <label class="w3-text-blue"><b>Option D</b></label>
                <input class="w3-input w3-border" name="d" type="text"value="<?php echo $row['d'] ?>"></p>

            <p>      
                <label class="w3-text-blue"><b>Correct Answer</b></label>
                <input class="w3-input w3-border" name="correct_answer" type="text"value="<?php echo $row['correct_answer'] ?>"></p>

            <p>      
                <button class="w3-btn w3-blue">Update Details</button>
                <button class="w3-btn w3-blue"onclick="history.go(-1)">Cancel</button>
             
            </p>

        </form>
        </section>
<footer>
            <?php require_once '../../includes/admin/footer.inc.php';?>
        </footer>
    </body>
</html>
