<?php
function db_connect()
{
	$db = @new mysqli('localhost','root','','my_wow');
	$db->query('SET NAMES "UTF8"');	
	if(mysqli_connect_errno())
	{
		echo "数据库连接失败！",'<br />';
		echo mysqli_connect_errno();
		exit;
	}
	return $db;
}
?>
