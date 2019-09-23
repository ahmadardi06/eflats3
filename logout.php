<?php
session_start();
session_destroy();
header('location: /eflats3/index.php');
?>