﻿  <?php
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

$q=mysql_query("SELECT CAV_xar.*,CAV_param.name from CAV_xar
				left join CAV_param on CAV_param.id=CAV_xar.id_par
				where id_parent is NULL and id_ind=".$_GET["id_ind"]);
unset($qqp);				
while ($qqp[]=mysql_fetch_array($q,MYSQL_ASSOC)){}


echo"<table>";
 $i_n=1; 
 foreach ($qqp as $rp)
	if($rp["id"]!="")
	{    
	 echo"<tr><td>".$i_n."</td>";
	 echo"<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">".$rp["name"]."</td>";
	 echo"<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">".$rp["val"]."</td>";
	 echo"</tr>";
	 
	 $q=mysql_query("SELECT CAV_xar.*,CAV_param.name from CAV_xar
				left join CAV_param on CAV_param.id=CAV_xar.id_par
				where id_parent=".$rp["id"]);
unset($qqp1);				
while ($qqp1[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

echo"<tr><td></td><td colspan=2>";
echo"<table>";
  
 foreach ($qqp1 as $rp1)
	if($rp1["id"]!="")
	{    
	 echo"<tr>";
	 echo"<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">".$rp1["name"]."</td>";
	 echo"<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">".$rp1["val"]."</td>";
	 echo"</tr>";
	}
	
echo"</table>";
echo"</td></tr>";
$i_n++;
	}
	
$q=mysql_query("select * from CAV_param");
unset($qqp);				
while ($qqp[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

echo "<tr><td colspan=4><form action=\"par_and_xar.php\"> 
<p>Параметр<select id=id_par name=id_par>";

foreach($qqp as $rp)
	if($rp["name"]!="")
		{
echo "<option value=".$rp["id"].">";
		echo $rp["name"];
		echo "</option>";
		}
echo "</select></p>
<p>Значение<input id=val name=val></p>
<input id=btn_xar name=btn_xar type=submit value=\"Добавить строку\"></form></td></tr>";
echo"</table>";
  ?>