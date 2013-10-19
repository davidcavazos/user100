<?php

//switch (htmlspecialchars($_GET['ctl'])) {
require_once('ctl/LoginCtl.php');
$ctl = new LoginCtl();

$ctl->ejecutar();

?>
