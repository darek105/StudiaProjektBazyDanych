<?php

if(isset($_POST['team']))
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
			$stmt = $db_con->prepare("SELECT * FROM pracownicy");
			$stmt->execute();
			return $stmt->fetchAll();
		}

		$data = getContent();
		foreach ($data as $row) {
			$arrayName = array(	 	 'pesel' =>  $row['PESEL'],
														 'imie'  =>  $row['IMIĘ'],
														 'nazwisko'  =>  $row['NAZWISKO'],
														 'stanowisko' =>  $row['STANOWISKO'],
														 'telefon' =>  $row['TELEFON'],
														 'idoddzialu' =>  $row['ID_ODDZIAŁU']
													 );
					$array[] = $arrayName;
		}

echo json_encode($array, JSON_PRETTY_PRINT);


	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}


//DODAWANIE PRACOWANIKA


if(isset($_POST['dodajPracownika']))
{
	try
	{

			$imie = trim($_POST['imie']);
			$nazwisko = trim($_POST['nazwisko']);
			$stanowisko = trim($_POST['stanowisko']);
			$pesel = trim($_POST['pesel']);
			$telefon = $_POST['telefon'];
			$oddzial = $_POST['oddzial'];
			$haslo = $_POST['hasło'];

			$stmt = $db_con->prepare("INSERT INTO pracownicy (PESEL, IMIĘ, NAZWISKO, STANOWISKO, TELEFON, ID_ODDZIAŁU, HASŁO) VALUES (:pesel, :imie, :nazwisko, :stanowisko, :telefon, :oddzial, :haslo)");
			$stmt->execute(array(":pesel"=>$pesel, ':imie'=>$imie, ':nazwisko'=>$nazwisko, ':stanowisko'=>$stanowisko, ':telefon'=>$telefon, ':oddzial'=>$oddzial, ':haslo'=>$haslo));

			$stmt1 = $db_con->prepare("SELECT * FROM pracownicy WHERE PESEL=:pesel");
			$stmt1->execute(array(":pesel"=>$pesel));
			$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

			if($row1['NAZWISKO'] == $nazwisko){

				echo "OK"; // log in
			}
			else{

				echo "NIE DODANO"; // wrong details
			}



	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}


//USUWANIE PRACOWNIKOW

if(isset($_POST['yesDelete']))
{
	try
	{

			$imie = trim($_POST['imie']);
			$nazwisko = trim($_POST['nazwisko']);
			$pesel = trim($_POST['pesel']);

			$stmt = $db_con->prepare("DELETE FROM pracownicy WHERE PESEL=:pesel");
			$stmt->execute(array(":pesel"=>$pesel));

				echo "OK"; //JESLI COS POJDZIE NIE TAK TO TRY CATCH ZWROCI BLAD

	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}


 ?>
