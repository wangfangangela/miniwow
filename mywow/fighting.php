<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-cn"/>
</head>
<body>
<?php
include('function.php');
session_start();
if(empty($_SESSION['uid']))
{
	echo "你没有登录不能访问此界面！";
	exit;
}
if(isset($_POST["boss_boss"]))
	echo "<font text-align = 'center' >welcome to fight with ",$_POST["boss_boss"],"!!!","</frot>",'<br />';
$conn = db_connect();
$boss = @$_POST["boss_boss"];
$rate = mt_rand(1,99)/100.00;

$sql = "SELECT 
	bs.boss_name, 
	bs.boss_hp,
	eq.eq_name,
	us.power
	FROM 
		wow_user As us,
		wow_boss AS bs, 
		wow_equipment AS eq, 
		relate AS re 
		WHERE bs.boss_name = '$boss' AND 
		re.boss_num = bs.boss_num AND 
		re.eq_num = eq.eq_num  AND
		re.p1 < '$rate' AND
		re.p2 >= '$rate'
		ORDER BY 
			eq.eq_num ASC";
	

$rs = $conn->query($sql);
$num = $rs->num_rows;


$row = $rs->fetch_array();
if($row['boss_hp']<= $row['power'])
{
	$power = $row['boss_hp']+$row['power'];
	echo "您战胜了",$row['boss_name'],'<br />',"散落装备为：",'<br />';
	echo $row['eq_name'],'<br />';
	$sq = " UPDATE wow_user SET power = '$power' WHERE username ='".$_SESSION['uid']."' ";
	$conn->query($sq);
}
else
	echo "很遗憾战斗失败！";
	
$conn->close();  

?>
</body>
</html>