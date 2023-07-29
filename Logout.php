<?php

@include 'Config.php';

session_start();
session_unset();
session_destroy();

header('localhost:Login.php');

?>