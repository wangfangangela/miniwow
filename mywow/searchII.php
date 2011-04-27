<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-cn"/>
</head>
<body>
<?php
include('header.php');
$link = mysql_connect('localhost','root','');
mysql_select_db('my_wow',$link);
mysql_query('SET NAMES "UTF8"');

$sql = "select
	us.site_name, 
	bs.boss_name, 
	eq.eq_name,
	bs.boss_hp
	from 
		wow_site as us, 
		wow_boss as bs, 
		wow_equipment as eq,
		relate as re
		where 
			us.site_num = bs.boss_site and
			re.boss_num = bs.boss_num and
			re.eq_num = eq.eq_num
			order by 
				us.site_num ASC , 
				bs.boss_num ASC";
		
$sq = mysql_query($sql);
$num = mysql_num_rows($sq);
//echo $num."<br />";
$i=1;
while($i<=$num)
{
	$row = mysql_fetch_array($sq);
	if($i == 1)
	{	
		$string1 = $row['site_name'];
		$string2 = $row['boss_name'];
		echo "副本：",$row['site_name'],'<br />',"boss:",$row['boss_name'],'<br />',"血量",'&nbsp',$row['boss_hp'],'<br />';
	}
	
	if( $string1 == $row['site_name'])
	{
		if( $string2 == $row['boss_name'])
			echo $row['eq_name'],' ';
		else
		{	$string2 = $row['boss_name'];
			echo '<br />',"boss:",$row['boss_name'],'<br />',"血量",'&nbsp',$row['boss_hp'],'<br />',$row['eq_name'],' ';
		}
	}
	if( $string1 != $row['site_name'])
	{
		$string1 = $row['site_name'];
		echo '<br />',"副本：",$row['site_name'],' ';
		if( $string2 == $row['boss_name'])
			echo $row['eq_name'],' ';
		else
		{	$string2 = $row['boss_name'];
			echo '<br />',"boss:",$row['boss_name'],'<br />',"血量",'&nbsp',$row['boss_hp'],'<br />',$row['eq_name'],' ';
		}
	}
	$i++;
} 
mysql_close($link);  

?>
</body>
</html>