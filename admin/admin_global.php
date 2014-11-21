<?php
session_start();
include_once ('../common/config.php');
include_once ('common/mysql.class.php');
include_once ('common/action.class.php');

$db = new action($mydbhost,$mydbuser,$mydbpw,$mydbname,ALL_PS,$mydbcharset);

$uid = $_SESSION[uid];
$shell = $_SESSION[shell];

?>
