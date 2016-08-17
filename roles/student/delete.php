<?php
require_once 'secure.inc.php';
session_start();
$username=$_SESSION['username'];
$time=$_GET['time'];
mysql_connect('localhost', 'root','') or die("Can\'t connect to server.");
mysql_select_db('oes') or die('The database is not Available');
$query="delete from history where username='$username' and time='$time'";
mysql_query($query);
header('Location:previous_results.php');
