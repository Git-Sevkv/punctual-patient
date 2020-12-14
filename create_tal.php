<form action="talon.php" method=get>
<h1 style="position: absolute;top: 1;">Планирование приёма:</h1>
<br>
<br>
<h3>Выберите врача:</h3>
<?php
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

$q=mysql_query("SELECT CAV_doctor.* ,
		CAV_individ.fam,CAV_doctor.n_kab,CAV_individ.login,CAV_individ.password
		from CAV_doctor 
		LEFT JOIN CAV_individ ON CAV_individ.id=CAV_doctor.id_ind_doc
		order by doctor
		");
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

echo "<select style=\"position: absolute; left: 160px;top: 66;\" name=id_doc >";
foreach($qq as $r)
	if($r["fam"]!="")
		{
		echo "<option value=".$r["id"].">";
		echo $r["doctor"]." ".$r["fam"]." каб.".$r["n_kab"];
		echo "</option>";
		}
echo "</select>";

	  
?>
						
						<p>Дата:<input name=s_d type=date></p>
						<p>Время начала приёма:<input name=t_s type=time></p>
						<p>Количество талонов:<input name=n_t></p>
						<p>Время одного приёма:<input name=dt></p>
						<p><input name=btn_beg type=submit value="Создать"></p>
						</form>