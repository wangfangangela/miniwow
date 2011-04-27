<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-cn"/>
	<title>Registering form</title>
	<link rel=stylesheet href="style.css" type="text/css" />
	<script type= "text/javascript" >
	function doCheck()
	{
		var username = document.frmRegister.username.value;
		var password = document.frmRegister.pwd.value;
		var repeat_pwd = document.frmRegister.repeat_pwd.value;
		var name = document.frmRegister.name.value;
		var email = document.frmRegister.email.value;
		if(username =='')
		{	alert('请输入用户名！'); return false; }
		else if(password =='')
		{	alert('请输入密码！'); return false; }
		else if(repeat_pwd =='')
		{	alert('请再次输入密码！'); return false; }
		else if(repeat_pwd != password)
		{	alert('重复密码与密码不一致'); return false; }
		
		return ture;
	}
	</script>
</head>


<body>
<div class = "frm">
<form name = "frmRegister" action = "register.php" method = "POST" onsubmit = "return doCheck();">

<table width = "330" border = "0" align = "center" cellpadding = "5" bgcolor = "#eeeeee">
	<tr>
		<td width = "40%">用户名：</td>
		<td><input name = "username" type = "text" id = "username" /> </td>
	</tr>
	<tr>
		<td width = "40%">密码：</td>
		<td><input name = "pwd" type = "password" id = "pwd" /> </td>
	</tr>
	<tr>
		<td width = "40%">重复密码：</td>
		<td><input name = "repeat_pwd" type = "password" id = "repeat_pwd" /> </td>
	</tr>
	<tr>
		<td width = "40%">姓名：</td>
		<td><input name = "name" type = "text" id = "name" /> </td>
	</tr>
	<tr>
		<td width = "40%">Email：</td>
		<td><input name = "email" type = "text" id = "email" /> </td>
	</tr>
	<tr>
		<td><a href = "login.php">返回登陆界面！</a></td>
		<td clospan="2" align = "center">
		<input type = "submit" name = "submit" value = "提交">
		<input type = "reset" name = "reset" value = "重置"></td>
	</tr>
</table>
</form>
</div>

<?php
include('function.php');
if(!empty($_POST["username"]))
{
	echo $_POST["username"];
	$conn = db_connect();
	$sql = "SELECT * FROM wow_user WHERE username = '".$_POST["username"]."' ";
	$rs = $conn->query($sql);
	if($rs && $rs->num_rows > 0)
		echo "<font color = 'red' size = '5' >此用户名已经被注册过，请换个注册名！</font><br /> ";
	else{
		$sql = "INSERT INTO wow_user (username, password,name,email,power) VALUES('".$_POST['username']."','".$_POST['pwd']."','".$_POST['name']."','".$_POST['email']."','2000')";
		$rs = $conn->query($sql);
		if(!$rs)
		{
			$conn->close();
			echo "数据库插入失败！";
			exit;
		}
		echo "<font color = 'red' size = '5' >恭喜你注册成功！</font><br /> ";
	}
	$conn->close();
}
?>

</body>
</html>