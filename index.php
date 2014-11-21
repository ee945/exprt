<?php
include_once ("global.php");

$tpl->assign("position","首页");

//判断登录
if(!empty($_POST[uname])&& !empty($_POST[upass])){
    $db->Get_user_login($_POST[uname],$_POST[upass]);
}

//退出登录
if($_GET[action]=='logout'){
    $db->Get_user_out();
}

//未登录时可以并仅能以快递单号搜索
if($_GET[searchnum]){
    $searchrs = $db->query("select * from `ex_record` where `rnum`='".$_GET[searchnum]."'");
    $searchrow = $db->fetch_array($searchrs);
    $tpl->assign("rnum",$searchrow[rnum]);
    $tpl->assign("rcom",$searchrow[rcom]);
    $tpl->assign("rstime",$searchrow[rstime]);
    $tpl->assign("rname",$searchrow[rname]);
    $tpl->assign("rtel",$searchrow[rtel]);
    $tpl->assign("raddr",$searchrow[raddr]);
    $tpl->assign("found","1");
    if ($db->db_num_rows($searchrs)==0){
        $tpl->assign("noresult","没有找到记录！");
        $tpl->assign("found","0");
    }
}

$tpl->assign("uname",$_SESSION[uname]);

$tpl->display("index.html");
 ?>