<?php
require_once 'secure.inc.php';
$course = $_REQUEST['course'];
mysql_connect('localhost', 'root', '') or die("Can't connect to the server.");
mysql_select_db('subjects') or die("Can't connect to the database.");
$query = "select * from $course";
$result = mysql_query($query);
?>
<table style="text-align: left;">
        <thead>
            <tr style="background-color: silver;">
                <th>Question Number</th>
                <th>Question</th>
                <th>Option A</th>
                <th>Option B</th>
                <th>Option C</th>
                <th>Option D</th>
                <th>Correct Answer</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row = mysql_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['question_number']; ?></td>
                <td><?php echo $row['question']; ?></td>
                <td><?php echo $row['a']; ?></td>
                <td><?php echo $row['b']; ?></td>
                <td><?php echo $row['c']; ?></td>
                <td><?php echo $row['d']; ?></td>
                <td><?php echo $row['correct_answer']; ?></td>
                <td><a title="Edit" href="edit.php?course=<?php echo $course;?>&question_number=<?php echo $row['question_number'];?>"><img src="../../images/edit.png"></a></td>
                <td><a  title="Delete" onclick="delete();"onclick="return confirm('This record will be deleted.')"href="delete.php?course=<?php echo $course;?>&question_number=<?php echo $row['question_number'];?>"><img src="../../images/drop.png"></a></td>
                <td></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<h3><a style="font-size: 20px; color: #00bcd4;"href="new_question.php?course=<?php echo $course;?>">Add new Question</a></h3>