<h1 style="position: absolute;left: 4%;top:1%;">Таблица параметров</h1>
<table style="position: absolute;left: 1%;top: 15%;">	
	<tr>
  <th align=center style="width:50;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>№</h2></th>
  <th align=center style="width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>Наименование</h2></th>
  <th align=center style="width:50;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>Экспертная оценка</h2></th>
 
 
  </tr>
<?php
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

$q=mysql_query("select * from CAV_param");
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

foreach($qq as $r)
	if($r["name"]!="")
		{
	
		echo "<tr>";
		echo "<td align=center style=\"width:50;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">".$r["id"]."</td>
		      <td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">".$r["name"]."</td>
			  <td align=center style=\"width:50;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">".$r["factor"]."</td>
			  ";

echo "<td>
	  <button title=\"Изменить\" onclick=\"
		  document.getElementById('id').value='".$r["id"]."';
		  document.getElementById('name').value='".$r["name"]."';
		  document.getElementById('factor').value='".$r["factor"]."';
		  document.getElementById('btn_e').value='Изменить';
		  document.getElementById('f_ind').style.display='block';
		  document.getElementById('fr_sp').style.display='none';
		  \">Изменить</button>
		  
		  <button title=\"Удалить\"
			   
			   onclick=\"
				   document.getElementById('id').value='".$r["id"]."';
				   document.getElementById('name').value='".$r["name"]."';
				   document.getElementById('factor').value='".$r["factor"]."';
				   document.getElementById('btn_e').value='Удалить';
				   document.getElementById('f_ind').style.display='block';
				   document.getElementById('fr_sp').style.display='none';
				  \"
			   
			   >Удалить</button>
		  </td>";
		echo "</tr>";
		}

echo "<tr><td colspan=3>
	  <button 
	  onclick=\"
	          document.getElementById('id').value='';
		  document.getElementById('name').value='';
		  document.getElementById('factor').value='';
		  document.getElementById('btn_e').value='Добавить';
		  document.getElementById('f_ind').style.display='block';
		  \"
	  >Добавить</button>
	  <form id=f_ind action=\"param.php\" method=get style=\"display:none;\">
	   <p style=\"display:none;\">№<input id=id name=id></p>
	   <p>Название<input id=name name=name></p>
	   <p>Экспертная оценка<input id=factor name=factor></p>
	   <p><input id=btn_e name=btn_e type=submit value=Добавить> 
	      <a
	      onclick=\"
	          document.getElementById('f_ind').style.display='none';
		  \"
	      >Отменить</a></p>
	  </form>
	 </td></tr>
</table>
      ";



if($_GET["btn_e"]=="Добавить")
   {$_GET["id"]=1;
	$q=mysql_query("select max(id)+1 as mxid from CAV_param");
	while ($str=mysql_fetch_array($q,MYSQL_ASSOC)){if($str["mxid"]!="")$_GET["id"]=$str["mxid"];}
	
    $q=mysql_query("insert into CAV_param (id,name,factor) 
		   values(".$_GET["id"].",
		      '".$_GET["name"]."',
			  '".$_GET["factor"]."')");
			  
     echo "<h3>Добавлен: ".$_GET["name"]."</h3>";
    }

if($_GET["btn_e"]=="Изменить")
   {
    $q=mysql_query("update CAV_param 
                    set name='".$_GET["name"]."',
		        factor='".$_GET["factor"]."'
		    where id=".$_GET["id"]);


     echo "<h3>Изменены данные: ".$_GET["name"]."</h3>";
    }
	
	if($_GET["btn_e"]=="Удалить")
   {
    $q=mysql_query("delete from CAV_param 
   		          where id=".$_GET["id"]);


     echo "<h3>Удалён: ".$_GET["name"]."</h3>";
    }
?>