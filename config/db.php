<?php
// environment for database
$host = "localhost";
$user = "root";
$pass = "";
$name = "eflats";

$db = new mysqli($host, $user, $pass, $name);

// environment for name directory
$BASEAPP = "eflats";

// environment for base url for the apps
$BASEURL = "http://localhost:81/".$BASEAPP;

?>