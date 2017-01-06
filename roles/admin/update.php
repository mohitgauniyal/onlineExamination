<?php
require_once 'secure.inc.php';
mysql_connect('localhost','root','') or die("Can't connect to server");
mysql_select_db('subjects')  or die("Can't connect to server");
$course=$_GET['course'];
$question_number=$_POST['question_number'];
$question=$_POST['question'];
$a=$_POST['a'];
$b=$_POST['b'];
$c=$_POST['c'];
$d=$_POST['d'];
$correct_answer=$_POST['correct_answer'];
$query="update $course set question='$question',a='$a',b='$b',c='$c',d='$d',correct_answer='$correct_answer' where question_number=$question_number";
mysql_query($query);
header('Location:index.php?update=true');
        