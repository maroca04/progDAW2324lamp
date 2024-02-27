<?php

require_once "autoloader.php";
$cartera= new Cartera("data.csv");
$cartera->delete(isset($_GET['id']) ? $_GET['id'] : null);
header("location: lista.php");
