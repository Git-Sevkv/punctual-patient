﻿﻿﻿﻿﻿﻿﻿﻿﻿<h1 style="position: absolute;left: 1%;top:1%;font-style: italic;text-decoration:underline;">Выберите врача:</h1>
<?php
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

$q=mysql_query("SELECT CAV_doctor.* ,
		CAV_individ.fam,CAV_doctor.n_kab,CAV_individ.login,CAV_individ.password
		from CAV_doctor 
		LEFT JOIN CAV_individ ON CAV_individ.id=CAV_doctor.id_ind_doc");
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

echo "<select onclick=\"document.getElementById('fr_sp').src='calendar/index.php?us=pac&id_doc='+this.value;\">";
foreach($qq as $r)
	if($r["fam"]!="")
		{
		echo "<option value=".$r["id"].">";
		echo $r["doctor"]." ".$r["fam"]." каб.".$r["n_kab"];
		echo "</option>";
		}
echo "</select>";

	  
?>
<iframe id=fr_sp src=""
        style="position: absolute;left: 1%;top: 10%;width:98%;height:80%;"
></iframe>

<a href="http://agniinfo.ru/st2016/Chernaya/hospital/registration.php"
  style="position: absolute; top: 30; left: 350"><button style="background-color: #f5e8d0;width: 130px; height: 40px;border-radius: 10px;font-style: italic;">Вернуться назад</button><img src="strelka.png" width="40"
 onmouseover="this.width=50;"
 onmouseout="this.width=40;"></a>