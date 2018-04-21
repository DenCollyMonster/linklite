<?php

require_once('./core/class-core.php');

$Core->start();

//header('Content-type: application/xml');

//$e->err( '00000', __FILE__, __LINE__ );

$Core->qwerty1v( $_GET, $_POST );

?>