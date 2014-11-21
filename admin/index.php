<?php
include_once ('admin_global.php');
 if(!empty($_POST[username])&& !empty($_POST[password])) $db->Get_user_login($_POST[username],$_POST[password]);
?>

<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title>后台管理</title>
<link rel='stylesheet' type='text/css' href='admin.css'>
<script> if(self!=top){ window.open(self.location,'_top'); } </script>
</head>
<body>
<br>
<form action="" method="post">
  <table border=0 cellspacing=1 align=center class=form>
    <tr>
      <th colspan="2">用户登录</th>
    </tr>
    <tr>
      <td align="right">登录用户:</td>
      <td><input type="text" name="username" value="" size="20" maxlength="40"/></td>
    </tr>
    <tr>
      <td align="right">登录密码:</td>
      <td><input type="password" name="password" value="" size="20" maxlength="40"/>  </td>
    </tr>
    <tr>
      <td colspan="2" align="center" height='30'><input type="submit" name="update" value=" 登录 "/></td>
    </tr>
  </table>
</form>
</body>
</html>