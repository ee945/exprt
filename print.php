<?php
include_once ("global.php");
$r=$db->Get_user_shell_check($uid, $shell);

if (isset($_GET[prid])){
  $rlist = $db->query("select * from `ex_record` where `rid`='".$_GET[prid]."'");
  $rrow=$db->fetch_array($rlist);
  $tpl->assign("rnum",$rrow[rnum]);
  $tpl->assign("rexcom",$rrow[rexcom]);
  $tpl->assign("rcata",$rrow[rcata]);
  $tpl->assign("rcont",$rrow[rcont]);
  $tpl->assign("remark",$rrow[remark]);
  $tpl->assign("rstime",$rrow[rstime]);
  $tpl->assign("rname",$rrow[rname]);
  $tpl->assign("rtitle",$rrow[rtitle]);
  $tpl->assign("rcom",$rrow[rcom]);
  $tpl->assign("rtel",$rrow[rtel]);
  $tpl->assign("raddr",$rrow[raddr]);
  $tpl->assign("rcity",$rrow[rcity]);
  $tpl->assign("sname",$rrow[sname]);
  $tpl->assign("scom",$rrow[scom]);
  $tpl->assign("stel",$rrow[stel]);
  $tpl->assign("saddr",$rrow[saddr]);
  $tpl->assign("scity",$rrow[scity]);

  switch ($_POST[excom]){
  	case "STO":
      $tpl->display("print_sto.html");
      break;
    case "WB":
      $tpl->display("print_wb.html");
      break;
    default:
      $tpl->display("print_sto.html");
      break;
  }

}
?>
