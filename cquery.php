<?php
include_once("global.php");

$r=$db->Get_user_shell_check($uid, $shell);
$tpl->assign("uname",$_SESSION[uname]);

//本页面用于添加快递记录时,自动填写客户数据

//通过客户代码查询数据
$clist = $db->query("select * from `ex_client` where `cabbr`='".$_GET[cabbr]."'");
$rowcabbr = $db->fetch_array($clist);
//转化为json格式后返回
echo $str = json_encode($rowcabbr);

?>
