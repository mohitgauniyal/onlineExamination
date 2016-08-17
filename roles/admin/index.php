<?php
require_once 'secure.inc.php';
mysql_connect('localhost', 'root', '') or die("Can't connect to the server.");
mysql_select_db('subjects') or die("Can't connect to the database.");

$name=$_POST['name'];
if(isset($_POST['add'])){
$sql = "CREATE TABLE `subjects`.$name(`question_number` INT(3) NOT NULL, `question` VARCHAR(500) NOT NULL, `a` VARCHAR(100) NOT NULL, `b` VARCHAR(100) NOT NULL, `c` VARCHAR(100) NOT NULL, `d` VARCHAR(100) NOT NULL, `correct_answer` VARCHAR(100) NOT NULL, PRIMARY KEY (`question_number`)) ENGINE = MyISAM;";
$status=1;
if(mysql_query($sql)){
    $msg="New Subject $name successfully created.";
}else{
    $msg="New Subject $name couldn't be created.";
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
        
       <script>
        function change(){
            var c=document.getElementById("course").value;
            var req=new XMLHttpRequest();
            req.onreadystatechange=function(){
                document.getElementById("content").innerHTML = req.responseText;
            }
            var data = "course="+c;
                req.open("get","list.php?"+data,true);
                req.send(null);
        }
        </script>
        <title></title>
    </head>
    <body>
        <nav>
            <?php require_once '../../includes/admin/nav.inc.php' ?>  
        </nav>
        <section style="background-color:transparent; padding: 15px;">
            <h2>Hello,<?php echo $_SESSION['name'] . ' !'; ?></h2><hr>


            <h1>Select a Subject</h1>

            <select class="w3-select w3-border" id="course" onchange="change();">
                <option value="" disabled selected>Choose your option</option>
                <?php
                $query = "show tables";
                $result = mysql_query($query);
                while ($row = mysql_fetch_array($result)) {
                    ?>
                    <option><?php echo $row[0]; ?></option>
                    <?php }
                ?>
            </select>
            <div id="content"></div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <p>
            <h2 style="font-size: 20px; color: #00bcd4;">Add new Subject</h2>
            <input class="w3-input w3-border" name="name" type="text">
            <button class="w3-btn w3-blue" name="add">Add</button>
            </p>
            </form>
            <?php if ($status==1) { ?>
            <h2 style="color:green;"><?php echo $msg;?></h2>
            <?php } ?>
        </section>
        <footer>
            <?php require_once '../../includes/admin/footer.inc.php';?>
        </footer>
    </body>
</html>
