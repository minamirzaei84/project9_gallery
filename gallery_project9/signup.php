<?php
require 'includes/init.php';

$user= new User();
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$uname=$_POST['uname'];
$pass=$_POST['pass'];

$res = $user->signup($fname, $lname, $uname, $pass);
if ($res == TRUE)
{
$_SESSION['msg']="Sign up successfully!";
}
redirect('index.php');