<?php

$hash = $_GET['hash'];

$path = './template/' . $hash . '.htm';
//header("Content-type: text/html");

include($path);

?>