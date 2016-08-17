<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../../login.php');
} else if ($_SESSION['role'] != 'student') {
    header('Location:../../login.php');
}
?>