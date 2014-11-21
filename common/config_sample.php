<?php
$mydbhost       ="";    //配置主机
$mydbuser       ="";    //数据库用户名
$mydbpw         ="";    //数据库密码
$mydbname       ="";    //数据库名称
$mydbcharset    ="utf8";    //数据库编码

date_default_timezone_set ('Asia/Shanghai');  //时区设置

//======== smarty 参数 =========
$smarty_template_dir    ='./templates/sysv1/';
$smarty_compile_dir     ='./templates_c/';
$smarty_config_dir      ='./';
$smarty_cache_dir       ='./cache/';
$smarty_caching         =false;
$smarty_delimiter       =explode("|","{|}");











?>
