<?php
session_start();
$torolni = $_GET['file'];
unlink($torolni);
header("Location: upload.php");
?>