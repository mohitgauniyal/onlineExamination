<?php
require_once 'secure.inc.php';
mysql_connect('localhost', 'root', '') or die("Can't connect to the server.");
mysql_select_db('subjects') or die("Can't connect to the database.");
$course=$_GET['course'];
$question_number=$_GET['question_number'];
$query="DELETE from $course WHERE question_number=$question_number";
mysql_query($query);
mysql_close();
header('Location:index.php?delete=true');
