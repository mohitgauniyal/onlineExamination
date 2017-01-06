<?php
require_once 'secure.inc.php';
session_start();
$name = $_SESSION['name'];
$username = $_SESSION['username'];
require_once '../../includes/db.inc.php';
$query = "SELECT * FROM `users` WHERE username = '$username'";
$result = mysql_query($query);

function make_name($name) {
    $new_name = ucfirst(str_replace('_', ' ', $name));
    return $new_name;
}

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
            .button {
                border-radius: 4px;
                background-color: blueviolet;
                border: none;
                color: #FFFFFF;
                text-align: center;
                font-size: 28px;
                padding: 20px;
                width: 200px;
                transition: all 0.5s;
                cursor: pointer; 
               margin: 5px;
            }

            .button span {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
            }

            .button span:after {
                content: '»';
                position: absolute;
                opacity: 0;
                top: 0;
                right: -20px;
                transition: 0.5s;
            }

            .button:hover span {
                padding-right: 25px;                
            }

            .button:hover span:after {
                opacity: 1;
                right: 0;
            }

        </style>
        <title></title>
    </head>
    <body>
        <nav>
            <?php require_once '../../includes/student/nav.inc.php'; ?>
        </nav>
        <section style="background-color:white">
            <div class="w3-card-12" style="width:20%; height: 20%; margin: 20px;">
                <img src="../../images/users/<?php echo $row['photo']; ?>" alt="<?php echo $row['name'];?>" style="width:100%;">
                <div class="w3-container w3-center">
                    <p><?php echo $row['name']?></p>
                </div>
            </div>

            <h2 style="color:blue; font-family: serif;">Instructions&nbsp;:</h2>
            <ul>
                <li>You'll be given fix time to answer MCQs.</li>
                <li>You may Submit your answers earlier by clicking upon "Submit" button.</li>
                <li>You can move to next or previous question to reselect your answer.</li>
            </ul>
           <?php
            mysql_connect('localhost', 'root', '') or die("Can't connect to server");
            mysql_select_db('subjects') or die("Can't connect to server");
            $query = "show tables";
            $result = mysql_query($query);
            $loop_counter = 0;
            ?>
            <table>
                <tr>
                    <?php
                    while ($row = mysql_fetch_array($result)) {
                        $loop_counter++;
                        ?>
                    <div>
                        <?php $name = make_name($row[0]); ?>
                        <td><a href="subject.php?subject=<?php echo $row[0]; ?>"><button class="button"><span><?php echo $name; ?></span></button></a></td>
                    <?php
                    if ($loop_counter == 4) {
                        echo '</tr>';
                        $loop_counter = 0;
                    }
                    echo '</div>';
                }
                ?>
                    
            </table>
         </section>
        <footer>
            <?php require_once '../../includes/student/footer.inc.php'; ?>
        </footer>
    </body>
</html>
