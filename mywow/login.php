<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-cn"/>
	<title>User login</title>
	<link rel=stylesheet href="style.css" type="text/css" />
	<script type = "text/javascript">
	function doCheck()
	{
		var username = document.frmLogin.username.value;
		var password = document.frmLogin.password.value;
		if(username =='')
		{	alert('请输入用户名！'); return false; }
		else if(password =='')
		{	alert('请输入密码！'); return false; }
		return ture;
	}
	
	</script>
	
</head>

<body>
<div class = "frm">
<form name = "frmLogin" method = "POST" action = "login.php" onsubmit = "return doCheck();"  >
<table border = "0" cellpadding = "8" width = "330" align = "center" bgcolor = "#eeeeee">
	<tr><td colspan = "alert" align = "center" class = "alert"></td></tr>
	<tr><td>用户名：</td>
		<td><input type = "text" name = "username" id = "username" ></td>
	</tr>
	
	<tr><td>密码：</td>
		<td><input type = "password" name = "password" id = "password"></td>
	</tr>
	<tr>
	<td><a href = "register.php">注册点击这里！</a></td>
	<td colspan = "2" align = "center">
	<input type = "submit" value = "登录">
	<input type = "reset" value = "重置">
	</td>
	</tr>
</table>
</form>
</div>
<?php
include('function.php');
if(!empty($_POST["username"]) &&  !empty($_POST["password"]))
{
	$conn = db_connect();
	$sql = "SELECT * FROM wow_user WHERE username = '".$_POST["username"]."' AND password = '".$_POST["password"]."' ";
	$rs = $conn->query($sql);
	if($rs && $rs->num_rows > 0)
	{
		session_start();
		$_SESSION['uid'] = $_POST["username"];
		echo "<font color = 'red' size = '5' >登陆成功！</font><br />";
		header("location:choice.php");
	}	
	else{
		echo "<font color = 'red' size = '5' >用户名或密码错误！</font><br /> ";
	}
	$conn->close();
}
?>
</body>
</html>