<?php
session_start();
session_destroy();
require 'config/db.php';
header('location: /'.$BASEAPP.'/index.php');
?>