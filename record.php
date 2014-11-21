<?php
include_once ("global.php");
$r=$db->Get_user_shell_check($uid, $shell);
$tpl->assign("uname",$_SESSION[uname]);
$tpl->assign("position","快递记录");

//添加记录
if (isset($_POST[addrecord])){

  $rnum = addslashes($_POST[rnum]);
  $rexcom = addslashes($_POST[rexcom]);
  $rcata = addslashes($_POST[rcata]);
  $rcont = addslashes($_POST[rcont]);
  $remark = addslashes($_POST[remark]);

  $rname = addslashes($_POST[rname]);
  $rtitle = addslashes($_POST[rtitle]);
  $rcom = addslashes($_POST[rcom]);
  $rtel = addslashes($_POST[rtel]);
  $raddr = addslashes($_POST[raddr]);
  $rcity = addslashes($_POST[rcity]);

  $sname = addslashes($_POST[sname]);
  $scom = addslashes($_POST[scom]);
  $stel = addslashes($_POST[stel]);
  $saddr = addslashes($_POST[saddr]);
  $scity = addslashes($_POST[scity]);

  $db->query("insert into `ex_record` (`rid`,`rnum`,`rexcom`,`rcata`,`rcont`,`remark`,`rname`,`rtitle`,`rcom`,`rtel`,`raddr`,`rcity`,`sname`,`scom`,`stel`,`saddr`,`scity`,`rstime`) " .
        "value(NULL,'$rnum','$rexcom','$rcata','$rcont','$remark','$rname','$rtitle','$rcom','$rtel','$raddr','$rcity','$sname','$scom','$stel','$saddr','$scity','".date("Y-m-d H:i:s",time())."')");
  $db->Get_admin_msg("record.php","添加记录成功！");
}

if (isset($_GET[delrid])){

  //判断登录用户权限
  if($_SESSION[ugrade]>1){ ?>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <script type="text/javascript">
    alert("无权删除！");
    javascript:history.go(-1);
    </script>
  <?php
  }else{
  $db->query("DELETE FROM `ex_record` WHERE `rid` = '$_GET[delrid]' LIMIT 1");
  $db->Get_admin_msg("record.php","删除记录成功！");
  }
}

//查询记录列表，叠加查询条件
$filt_sql="select * from `ex_record` where `rid`!=''";
if($_POST[s_num]!=""){$filt_sql.=" && rnum='".$_POST[s_num]."'";}
if($_POST[s_name]!=""){$filt_sql.=" && rname='".$_POST[s_name]."'";}
if($_POST[s_com]!=""){$filt_sql.=" && rcom='".$_POST[s_com]."'";}
if($_POST[s_start]!=""){$filt_sql.=" && rstime>='".$_POST[s_start]." 00:00:00'";}
if($_POST[s_end]!=""){$filt_sql.=" && rstime<='".$_POST[s_end]." 23:59:59'";}
//echo $filt_sql;
$rlistnum = $db->query($filt_sql);
$total = $db->db_num_rows($rlistnum);
$displaypg = 2;
pageft($total,$displaypg);
if ($firstcount < 0){$firstcount = 0;}
$limit_sql=$filt_sql." order by `rstime` desc limit $firstcount,$displaypg";
$rlist = $db->query($limit_sql);
while ($rrow = $db->fetch_array($rlist)){
  $r_list[] = array(
    "rid"=>$rrow[rid],
    "rnum"=>$rrow[rnum],
    "rexcom"=>$rrow[rexcom],
    "rcata"=>$rrow[rcata],
    "rcont"=>$rrow[rcont],
    "rstime"=>$rrow[rstime],
    "rname"=>$rrow[rname],
    "rcom"=>$rrow[rcom],
    "sname"=>$rrow[sname]);
}



//显示更新客户信息
if (isset($_GET[updaterid])){
  $ifupdater=1;  //此变量“ifupdater”用于判断模板页面该显示“修改页面”“添加页面”或者默认“列表页面”
  $rlist1 = $db->query("select * from `ex_record` where `rid`='".$_GET[updaterid]."'");
  $rrow1=$db->fetch_array($rlist1);
  $tpl->assign("ifupdater",$ifupdater);
  $tpl->assign("rnum1",$rrow1[rnum]);
  $tpl->assign("rexcom1",$rrow1[rexcom]);
  $tpl->assign("rcata1",$rrow1[rcata]);
  $tpl->assign("rcont1",$rrow1[rcont]);
  $tpl->assign("remark1",$rrow1[remark]);
  $tpl->assign("rstime1",$rrow1[rstime]);
  $tpl->assign("rname1",$rrow1[rname]);
  $tpl->assign("rtitle1",$rrow1[rtitle]);
  $tpl->assign("rcom1",$rrow1[rcom]);
  $tpl->assign("rtel1",$rrow1[rtel]);
  $tpl->assign("raddr1",$rrow1[raddr]);
  $tpl->assign("rcity1",$rrow1[rcity]);
  $tpl->assign("sname1",$rrow1[sname]);
  $tpl->assign("scom1",$rrow1[scom]);
  $tpl->assign("stel1",$rrow1[stel]);
  $tpl->assign("saddr1",$rrow1[saddr]);
  $tpl->assign("scity1",$rrow1[scity]);
  $tpl->assign("position","修改快递记录");
}

if (isset($_GET[addr])){
  $ifupdater=2;
  $sql = $db->query("select * from `ex_user` where `uid`='$_SESSION[uid]'");
  $row=$db->fetch_array($sql);
  $tpl->assign("uabbr1",$row[uabbr]);
  $tpl->assign("ucom1",$row[ucom]);
  $tpl->assign("utel1",$row[utel]);
  $tpl->assign("uaddr1",$row[uaddr]);
  $tpl->assign("ucity1",$row[ucity]);
  $tpl->assign("ifupdater",$ifupdater);
  $tpl->assign("position","添加记录");
}


//更新记录
if (isset($_POST[updaterecord])){

  $rnum = addslashes($_POST[rnum]);
  $rexcom = addslashes($_POST[rexcom]);
  $rcata = addslashes($_POST[rcata]);
  $rcont = addslashes($_POST[rcont]);
  $remark = addslashes($_POST[remark]);

  $rname = addslashes($_POST[rname]);
  $rtitle = addslashes($_POST[rtitle]);
  $rcom = addslashes($_POST[rcom]);
  $rtel = addslashes($_POST[rtel]);
  $raddr = addslashes($_POST[raddr]);
  $rcity = addslashes($_POST[rcity]);

  $sname = addslashes($_POST[sname]);
  $scom = addslashes($_POST[scom]);
  $stel = addslashes($_POST[stel]);
  $saddr = addslashes($_POST[saddr]);
  $scity = addslashes($_POST[scity]);

  $db->query("UPDATE  `ex_record` SET  " .
        "`rnum` = '$rnum'," .
        "`rexcom` = '$rexcom'," .
        "`rcata` = '$rcata'," .
        "`rcont` = '$rcont'," .
        "`remark` = '$remark'," .
        "`rname` = '$rname'," .
        "`rtitle` = '$rtitle'," .
        "`rcom` = '$rcom'," .
        "`rtel` = '$rtel'," .
        "`raddr` = '$raddr'," .
        "`rcity` = '$rcity'," .
        "`sname` = '$sname'," .
        "`scom` = '$scom'," .
        "`stel` = '$stel'," .
        "`saddr` = '$saddr'," .
        "`scity` = '$scity' " .
        "WHERE  `ex_record`.`rid` ='$_GET[updaterid]' LIMIT 1 ;");
  $db->Get_admin_msg("record.php","更新记录成功！");
}

$tpl->assign("r_list",$r_list);
$tpl->assign("pagenav", $pagenav);
$tpl->display("record.html");
?>
