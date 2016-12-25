<?php

if(isset($_POST['paczki']))
{
	try
	{

		function getContent()
		{
			$db_host = "localhost";
			$db_name = "platforma_zpid";
			$db_user = "root";
			$db_pass = "campus";
			$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
			$stmt = $db_con->prepare("SELECT * FROM paczki");
			$stmt->execute();
			return $stmt->fetchAll();
		}

		$data = getContent();
		foreach ($data as $row) {
			$arrayName = array('id_paczki' =>  $row['ID_PACZKI'],
														 'data_w'  =>  $row['DATA_WYSŁANIA'],
														 'data_p'  =>  $row['DATA_PRZYJĘCIA'],
														 'departament'  =>   $row['DEPARTAMENT'],
														 'ilosc_pro' =>  $row['ILOSC_PRODUKTÓW'],
													 );
					$array[] = $arrayName;
		}

echo json_encode($array, JSON_PRETTY_PRINT);


	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

if(isset($_POST['paczki-details']))
{
	$id_paczki = trim($_POST['paczka-details']);
	try
	{

		function getContent()
		{
			$db_host = "localhost";
			$db_name = "platforma_zpid";
			$db_user = "root";
			$db_pass = "campus";
			$id_paczki = trim($_POST['paczka-details']);
			$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
			$stmt = $db_con->prepare("SELECT * FROM paczki");
			$stmt->execute();
			$stmt = $db_con->prepare("SELECT * FROM zawartość_paczki WHERE ID_PACZKI=:id_paczki");
			$stmt->execute(array(":id_paczki"=>$id_paczki));
			return $stmt->fetchAll();
		}

		$data = getContent();
		foreach ($data as $row) {
			$arrayName = array('identyfikator' =>  $row['IDENTYFIKATOR'],
														 'idpaczki'  =>  $row['ID_PACZKI'],
														 'idproduktu'  =>  $row['ID_PRODUKTU'],
														 'ilosc_pro' =>  $row['ILOŚĆ'],
													 );
					$array[] = $arrayName;
		}

echo json_encode($array, JSON_PRETTY_PRINT);


	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

 ?>
