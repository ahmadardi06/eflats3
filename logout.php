<?php
// destroy all session
session_start();
session_destroy();
require 'config/db.php';

// redirect to index.php
header('location: /'.$BASEAPP.'/index.php');
?>