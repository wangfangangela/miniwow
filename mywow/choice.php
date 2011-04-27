<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-cn"/>
	<link rel=stylesheet href="style.css" type="text/css" />
</head>
<body >
<div class = "choice">
<?php
include('function.php');
session_start();
if(empty($_SESSION['uid']))
{
	echo "您没有登陆，不能访问此界面！";
	exit;
}
include('header.php');
$conn = db_connect();
$sql = "select 
	us.site_name,
	bs.boss_num,
	bs.boss_name, 
	bs.boss_site 
	from 
        wow_site as us,
        wow_boss as bs 
        where us.site_num = bs.boss_site
        order by us.site_num asc";

$rs = $conn->query($sql);
$num = $rs->num_rows;
$i=1;
echo '<h2>请选择你要战斗的boss！</h2>';
echo '<form action ="fight.php" method = "POST">';


while($i<=$num)
{
  if($i==1)
  {
	$row = $rs->fetch_array();
	$string = $row['site_name'];
	echo "场景：",$row['site_name'], '<br />','<input type = "radio" name = "boss_boss" value ="',$row['boss_name'],'"/>',$row['boss_name'],'<br />';
  }
  else
 {
	$row = $rs->fetch_array();
	if($string == $row['site_name'])
	{	
		echo '<input type = "radio" name = "boss_boss" value ="',$row['boss_name'],'"/>',$row['boss_name'],'<br />';
	}
	else
	{
		$string = $row['site_name'];
		echo '<br />',"场景：",$row['site_name'], "<br />",'<input type = "radio" name = "boss_boss" value ="',$row['boss_name'],'"/>',$row['boss_name'],'<br />';
	}
 }
  $i++;
}
echo '<input type="submit" value="选择完毕！" />';
echo '</form>';
$conn->close();  
?>
</div>


</body>
</html>