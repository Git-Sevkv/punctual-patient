﻿﻿﻿﻿﻿﻿﻿<?php

echo "
	  <form id=f_ind action=\"individ_edit.php\" method=get style=\"display:none;\"position: absolute;left: 2;\"\">
	  <h1 style=\"position: left: 5%;top: 100;\"
	  
	  >Зарегистрироваться</h1> <p>Фамилия<input id=fam name=fam></p>
	   <p>Имя<input id=name name=name></p>
	   <p>Отчество<input id=s_name name=s_name></p>
	   <p>Дата рождения<input id=date_of_brth name=date_of_brth type=date></p>
	   <p>Логин<input id=login name=login></p>
	   <p>Пароль<input id=password name=password type=password></p>
	   <p><input id=btn_e name=btn_e type=submit value=Зарегистрироваться> 
	   <span onclick=\"
	   
	    document.getElementById('login').value='';
		document.getElementById('password').value='';
		 document.getElementById('btn_e').value='Войти';
		   document.getElementById('aut_z').style.display='block';
	   
	   \">
	  
	      <a
	      onclick=\"
	          document.getElementById('f_ind').style.display='none';\"
	          
	      >Отменить</a></span>
		</p>
	  </form>
	  ";		  
	  
?>

<?php
session_start();
if(isset($_GET["exit"]))
	{unset($_SESSION["id"]);
	 unset($_SESSION["fam"]);
	 unset($_SESSION["name"]);
	 unset($_SESSION["s_name"]);
	 unset($_SESSION["date_of_brth"]);
	 unset($_SESSION["login"]);
	 unset($_SESSION["password"]);
	 
	}//очистка сессии
$Link=mysqli_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi','u464554');

if(!$Link)die('Нет подключения к БД!');

@mysqli_query($Link,'SET NAMES utf8');

if(isset($_GET["new_user"]))
	{
		$qn=mysqli_query($Link,"select max(id)+1 as mxid from CAV_individ");
		while ($qqn[]=mysqli_fetch_array($qn,MYSQLI_ASSOC)){}
		if($qqn[0]["mxid"]=="")$new_id=1;
		   else $new_id=$qqn[0]["mxid"];
		
		$qn=mysqli_query($Link,"insert into CAV_individ
								(id, fam, name, s_name, login, password)
								VALUES (".$new_id.",'".$_GET["fam"]."','".$_GET["name"]."','".$_GET["s_name"]."','".$_GET["login"]."','".$_GET["password"]."')
								");
		
	}
if(isset($_GET["login"]))
	{unset($_SESSION["id"]);
	 unset($_SESSION["fam"]);
	 unset($_SESSION["name"]);
	 unset($_SESSION["s_name"]);
	 unset($_SESSION["date_of_brth"]);
	 unset($_SESSION["login"]);
	 unset($_SESSION["password"]);
	 
	$q=mysqli_query($Link,"select *, (select count(*) from CAV_doctor where CAV_individ.id=CAV_doctor.id_ind_doc) as c_doc from CAV_individ 
							where login like '".$_GET["login"]."'
								and password like '".$_GET["password"]."'	
							");
	unset($qq);
	while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
	
	if($qq[0]["login"]!="")
			{ 
			 $_SESSION["fam"]=$qq[0]["fam"];
			 $_SESSION["name"]=$qq[0]["name"];
			 $_SESSION["s_name"]=$qq[0]["s_name"];
			 $_SESSION["id"]=$qq[0]["id"];
			 $_SESSION["c_doc"]=$qq[0]["c_doc"];
			 }
	
	}
	
if(isset($_SESSION["id"]))
	{ echo "Здравствуйте ".$_SESSION["name"]." ".$_SESSION["s_name"]."<form action=\"registration.php\" method=get>
	<p><input type=submit name=exit value=Выйти>
	</p>
	</form>";	
	}
	 
?>
<h1 style="position: absolute;left: 50%;top:1%;"></h1>
<?php


if(!isset($_SESSION["id"]))
echo "
<form id=aut_z action=\"registration.php\" method=get>
<h1>Авторизация</h1>
<p>Логин<input name=login></p>
<p>Пароль<input name=password type=password></p>
<p><input type=submit value=Войти>
<span onclick=\"
	   
		  document.getElementById('fam').value='';
		  document.getElementById('name').value='';
		  document.getElementById('s_name').value='';
		  document.getElementById('date_of_brth').value='';
		  document.getElementById('login').value='';
		  document.getElementById('password').value='';
		  document.getElementById('btn_e').value='Зарегистрироваться';
		  document.getElementById('f_ind').style.display='block';
		  \">
		    <a
	      onclick=\"
	          document.getElementById('aut_z').style.display='none';
		  \"
	      >
		  Регистрация</a>
		  </span>
		  
		  </p>
</form>
";
else echo "

";

if(isset($_SESSION["id"]))
echo "
<br>
<br>
<a href=\"sign_up.php\">Записаться на прием</a>
<br>
";

if(isset($_SESSION["id"]))
echo "
<br>
<br>
<a href=\"reception.php\">Прием</a>
<br>
";

if((isset($_SESSION["c_doc"]))&&($_SESSION["c_doc"]>0))
echo "
<br>
<br>
<a href=\"sign_up_doc.php\">Список пациентов</a>
<br>";





?>