<?php
include_once ("global.php");
$r=$db->Get_user_shell_check($uid, $shell);
$tpl->assign("uname",$_SESSION[uname]);
$tpl->assign("position","管理客户");

//添加客户
if (isset($_POST[addclient])){
//addslash处理提交字段，防止录入'出错，或sql注入
  $cabbr = addslashes($_POST[cabbr]);
  $cname = addslashes($_POST[cname]);
  $title = addslashes($_POST[ctitle]);
  $ccom = addslashes($_POST[ccom]);
  $ctel = addslashes($_POST[ctel]);
  $caddr = addslashes($_POST[caddr]);
  $ccity = addslashes($_POST[ccity]);

  $db->query("insert into `ex_client` (`cid`,`cabbr`,`cname`,`ctitle`,`ccom`,`ctel`,`caddr`,`ccity`) " .
        "value(NULL,'$cabbr','$cname','$ctitle','$ccom','$ctel','$caddr','$ccity')");
  $db->Get_admin_msg("client.php","添加客户成功！");
}

//查询客户列表
$clistnum = $db->query("select cid from `ex_client`");
$total = $db->db_num_rows($clistnum);
$displaypg = 20;
pageft($total,$displaypg);
if ($firstcount < 0)
    $firstcount = 0;
$clist = $db->findall("`ex_client` limit  $firstcount, $displaypg");
while ($crow = $db->fetch_array($clist)){
  $c_list[] = array("cid"=>$crow[cid],"cabbr"=>$crow[cabbr], "cname"=>$crow[cname],"ctitle"=>$crow[ctitle],"ccom"=>$crow[ccom],"ctel"=>$crow[ctel],"ccity"=>$crow[ccity]);
}

//显示更新客户信息
if (isset($_GET[updatecid])){
  $ifupdatec=1;  //此变量“ifupdatec”用于判断模板页面该显示“修改页面”“添加页面”或者默认“列表页面”
  $clist1 = $db->query("select * from `ex_client` where `cid`='".$_GET[updatecid]."'");
  $crow1=$db->fetch_array($clist1);
  $tpl->assign("ifupdatec",$ifupdatec);
  $tpl->assign("cname1",$crow1[cname]);
  $tpl->assign("cabbr1",$crow1[cabbr]);
  $tpl->assign("ctitle1",$crow1[ctitle]);
  $tpl->assign("ccom1",$crow1[ccom]);
  $tpl->assign("ctel1",$crow1[ctel]);
  $tpl->assign("caddr1",$crow1[caddr]);
  $tpl->assign("ccity1",$crow1[ccity]);
  $tpl->assign("crtime1",$crow1[crtime]);
  $tpl->assign("position","修改客户");  //主区域标题
}

if (isset($_GET[addc])){
  $ifupdatec=2;  //显示添加客户页面
  $tpl->assign("ifupdatec",$ifupdatec);
  $tpl->assign("position","添加客户");
}


//更新客户
if (isset($_POST[updateclient])){

  $cabbr = addslashes($_POST[cabbr]);
  $cname = addslashes($_POST[cname]);
  $title = addslashes($_POST[ctitle]);
  $ccom = addslashes($_POST[ccom]);
  $ctel = addslashes($_POST[ctel]);
  $caddr = addslashes($_POST[caddr]);
  $ccity = addslashes($_POST[ccity]);


  $db->query("UPDATE  `ex_client` SET  " .
        "`cabbr` = '$cabbr'," .
        "`cname` = '$cname'," .
        "`ctitle` = '$ctitle'," .
        "`ccom` = '$ccom'," .
        "`ctel` = '$ctel'," .
        "`caddr` = '$caddr'," .
        "`ccity` = '$ccity' " .
        "WHERE  `ex_client`.`cid` ='$_GET[updatecid]' LIMIT 1 ;");
  $db->Get_admin_msg("client.php","修改客户成功！");
}

$tpl->assign("c_list",$c_list);  //输出查询结果数组，smarty用section方法循环输出
$tpl->assign("pagenav", $pagenav);  //输出分页
$tpl->display("client.html");
?>
