<?php
require 'core.inc.php';
session_destroy();
$_SESSION['er.no']=NULL;
header('Location: ../index.php');
?>