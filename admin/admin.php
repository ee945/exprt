<?php
include_once ('admin_global.php');
$r=$db->Get_user_shell_check($uid, $shell);

if($_POST[adduser]){
    $sql=$db->query("select * from `ex_user` where `uname`='$_POST[uname]'");
    if($db->db_num_rows($sql)>=1){
    	echo "用户名已存在！";
    }else{
        $db->query("insert into `ex_user` (`uid`,`uname`,`uabbr`,`upass`,`ucom`,`utel`,`uaddr`,`ucity`,`urtime`)" .
                "value (NULL,'$_POST[uname]','$_POST[uabbr]','".md5($_POST[upass])."','$_POST[ucom]','$_POST[utel]','$_POST[uaddr]','$_POST[ucity]','".date("Y-m-d H:i:s",time())."')");
        echo "添加成功！";
    }

}

 $sql=$db->query("select * from `ex_user");
?>
<html>
<head>
<title>EXPRINTER ADMIN</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../common/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("input[name='adduser']").click(function(){
        if($("input[name='upass']").val()!=$("input[name='upassb']").val()){
        alert("两次密码不一致！");
        return false;
        }else if($("input[name='uabbr']").val()==""){
        alert("显示名不能为空！");
        return false;
        }else if($("input[name='uname']").val()==""){
        alert("用户名不能为空！");
        return false;
        }else if($("input[name='upass']").val()==""){
        alert("密码不能为空！");
        return false;
        }
    });
});
</script>
</head>
<body>
<table>
<tr>
<th>用户ID</th>
<th>用户名</th>
<th>显示名</th>
<th>公司</th>
<th>注册时间</th>
<th>上次登录</th>
</tr>
<?php
while ($row_arr=$db->fetch_array($sql)){
?>
<tr>
<td><?php echo $row_arr[uid]?></td>
<td><?php echo $row_arr[uname]?></td>
<td><?php echo $row_arr[uabbr]?></td>
<td><?php echo $row_arr[ucom]?></td>
<td><?php echo $row_arr[urtime]?></td>
<td><?php echo $row_arr[ultime]?></td>
</tr>
<?php
}
?>
</table>
<hr />
<form method="POST">
<table class="inputtab">
<tr>
  <td>用户名：</td>
  <td><input id="uname" type="text" size="20" name="uname"></td>
  <td></td>
</tr>
<tr>
  <td>显示名称：</td>
  <td><input id="uabbr" type="text" size="20" name="uabbr"></td>
  <td></td>
</tr>
<tr>
  <td>密码：</td>
  <td><input type="password" size="20" name="upass"></td>
  <td></td>
</tr>
<tr>
  <td>确认密码：</td>
  <td><input type="password" size="20" name="upassb"></td>
  <td></td>
</tr>
<tr>
  <td>公司：</td>
  <td><input type="text" size="20" name="ucom"></td>
  <td></td>
</tr>
<tr>
  <td>电话：</td>
  <td><input type="text" size="20" name="utel"></td>
  <td></td>
</tr>
<tr>
  <td>地址：</td>
  <td><input type="text" size="20" name="uaddr"></td>
  <td></td>
</tr>
<tr>
  <td>城市：</td>
  <td><input type="text" size="20" name="ucity" value="上海"></td>
  <td></td>
</tr>
<tr>
  <td><input type="submit" name="adduser" value="添加用户"></td>
  <td></td>
  <td></td>
</tr>
</table>
</form>
</body>
</html>