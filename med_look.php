﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿  <?php
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');
$q=mysql_query("SELECT * from CAV_doctor where exists(SELECT * from CAV_pac where CAV_pac.id_doc=CAV_doctor.id)");
unset($qq1);				
while ($qq1[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

$q=mysql_query("SELECT * from CAV_pac");
unset($qqp);				
while ($qqp[]=mysql_fetch_array($q,MYSQL_ASSOC)){}


echo"<table>
<tr>
  <th align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77\";></th>";

foreach ($qq1 as $r1)
	if($r1["id"]!="")
		echo"<th align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77\";><h2>".$r1["doctor"]."</h2></th>";
   
 echo"</tr>";
  
$q=mysql_query("SELECT * from CAV_individ where exists(SELECT * from CAV_pac where CAV_pac.id_ind_pac=CAV_individ.id)");
unset($qq);				
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

foreach ($qq as $r)
	if($r["id"]!="") 
		{
		 echo"<tr><td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">".$r["fam"]."</td>";
		 foreach ($qq1 as $r1)
			if($r1["id"]!="")
			{$find_pac=0;
			 foreach ($qqp as $rp)
				if(($r1["id"]==$rp["id_doc"])&&($r["id"]==$rp["id_ind_pac"]))
					{$find_pac=1;
					echo"<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">".$rp["time_way"]."</td>";
					}	
			if($find_pac==0)echo"<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\"></td>";
			}
		 echo"</tr>";
		}
echo"
</table>
";  
  ?>