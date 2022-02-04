<?php

$localhost = 'localhost';
$user = 'root';
$pw = '';
$db = 'ajax';

$conn = mysqli_connect($localhost, $user, $pw, $db) or die(mysqli_error());

$_SESSION['user'] = 1;