<?php
session_start();

require 'functions.php';

$db = new mysqli("localhost", "root", "", "db_gallery");
$db->query("SET NAMES 'utf8'");

spl_autoload_register(function($class) {

    $classpath=__DIR__."/classes/".$class.".php";
    if(file_exists($classpath))
    {
        require "$classpath";
    }

} );
