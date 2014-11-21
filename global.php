<?php
session_start();
include_once ('./common/config.php');
include_once ('./common/smarty/Smarty.class.php');
include_once ('./common/mysql.class.php');
include_once ('./common/action.class.php');
include_once ('./common/page.class.php');

$db = new action($mydbhost,$mydbuser,$mydbpw,$mydbname,ALL_PS,$mydbcharset);
$tpl = new Smarty();
$tpl->caching = $smarty_caching;
$tpl->template_dir = $smarty_template_dir;
$uid = $_SESSION[uid];
$shell = $_SESSION[shell];
?>
