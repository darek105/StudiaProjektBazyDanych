<?php

  //połączenie z baza danych

  $db_host = "localhost";
  $db_name = "platforma_zpid";
  $db_user = "root";
  $db_pass = "campus";

  try{

    	$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
    	$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }
  catch(PDOException $e){

    	echo $e->getMessage();

  }

 ?>
