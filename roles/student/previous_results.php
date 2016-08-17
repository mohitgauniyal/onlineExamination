<?php
require_once 'secure.inc.php';
require_once '../../includes/db.inc.php';
$status=0;
$username=$_SESSION['username'];
$query="select * from history where username='$username' order by time";
$result=  mysql_query($query);
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
        <section>
            <table style="text-align: left;">
        <thead>
            <tr style="background-color: silver;">
                <th>Date</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Correct answers</th>
                <th>Total questions</th>      
                <th>Delete History</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row = mysql_fetch_assoc($result)) {
                    $t=  strtotime($row['date']);
                    $t=date('d-M-Y',$t);
            ?>
            <tr>
                <td><?php echo $t; ?></td>
                <td><?php echo $row['time']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['num_correct_ans']; ?></td>
                <td><?php echo $row['num_qsn']; ?></td>   
                <td><a href="delete.php?time=<?php echo $row['time']; ?>"><img src="../../images/drop.png" alt=""/></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
            <hr>
            <input type="button" onclick="window.print();" value="Print result">
        </section>
        <footer>
            <?php require_once '../../includes/student/footer.inc.php'; ?>            
        </footer>
    </body>
</html>
