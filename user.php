<?php
include ("global.php");
$r=$db->Get_user_shell_check($uid, $shell);

$tpl->assign("position","用户信息");


//更新用户信息
if (isset($_POST[updateuser])){
  $md5pass = md5("$_POST[upass]");
  $uabbr = addslashes($_POST[uabbr]);
  $ucom = addslashes($_POST[ucom]);
  $utel = addslashes($_POST[utel]);
  $uaddr = addslashes($_POST[uaddr]);
  $ucity = addslashes($_POST[ucity]);

  $db->query("UPDATE  `ex_user` SET  " .
        "`uabbr` = '$uabbr'," .
        "`ucom` = '$ucom'," .
        "`utel` = '$utel'," .
        "`uaddr` = '$uaddr'," .
        "`ucity` = '$ucity' " .
        "WHERE  `ex_user`.`uid` ='$_SESSION[uid]' LIMIT 1 ;");
        $alertmsg="更新信息成功！";
    if($_POST[upass]<>""){
        $md5pass = md5("$_POST[upass]");
        $db->query("UPDATE  `ex_user` SET `upass` = '$md5pass' " .
        "WHERE  `ex_user`.`uid` ='$_SESSION[uid]' LIMIT 1 ;");
        $alertmsg="更新信息成功！密码已修改，请重新登录";
        session_destroy();
    }
  $db->Get_admin_msg("user.php",$alertmsg);
}

//显示用户信息
$sql = $db->query("select * from `ex_user` where `uid`='$_SESSION[uid]'");
$row=$db->fetch_array($sql);
$tpl->assign("uname",$row[uname]);
$tpl->assign("uabbr",$row[uabbr]);
$tpl->assign("ucom",$row[ucom]);
$tpl->assign("utel",$row[utel]);
$tpl->assign("uaddr",$row[uaddr]);
$tpl->assign("ucity",$row[ucity]);
$tpl->assign("urtime",$row[urtime]);
$tpl->assign("ultime",$row[ultime]);

$tpl->display("user.html");
?>