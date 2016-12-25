<?php

if(isset($_POST['formToChangeDane']))
{
	try
	{

			$pesel = $_POST['pesel-change'];

		  if(isset($_POST['imie'])) {


				$count = $_POST['imie'];
				$stmt1 = $db_con->prepare("UPDATE pracownicy SET IMIĘ=:count WHERE PESEL=:pesel");
				$stmt1->execute(array(":count"=>$count, ":pesel"=>$pesel));
			}

			if(isset($_POST['nazwisko'])) {


				$count = $_POST['nazwisko'];
				$stmt1 = $db_con->prepare("UPDATE pracownicy SET NAZWISKO=:count WHERE PESEL=:pesel");
				$stmt1->execute(array(":count"=>$count, ":pesel"=>$pesel));
			}

			if(isset($_POST['telefon'])) {


				$count = $_POST['telefon'];
				$stmt1 = $db_con->prepare("UPDATE pracownicy SET TELEFON=:count WHERE PESEL=:pesel");
				$stmt1->execute(array(":count"=>$count, ":pesel"=>$pesel));
			}

			if(isset($_POST['stanowisko'])) {


				$count = $_POST['stanowisko'];
				$stmt1 = $db_con->prepare("UPDATE pracownicy SET STANOWISKO=:count WHERE PESEL=:pesel");
				$stmt1->execute(array(":count"=>$count, ":pesel"=>$pesel));
			}

			if(isset($_POST['hasło'])) {


				$count = $_POST['hasło'];
				$stmt1 = $db_con->prepare("UPDATE pracownicy SET HASŁO=:count WHERE PESEL=:pesel");
				$stmt1->execute(array(":count"=>$count, ":pesel"=>$pesel));
			}

			$stmt = $db_con->prepare("SELECT * FROM pracownicy WHERE PESEL=:pesel");
			$stmt->execute(array(":pesel"=>$pesel));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$arrayName = array(	 	 'imie'  =>  $row['IMIĘ'],
														 'nazwisko'  =>  $row['NAZWISKO'],
														 'stanowisko' =>  $row['STANOWISKO'],
														 'telefon' =>  $row['TELEFON'],
														 'haslo' =>  $row['HASŁO']
													 );

	  echo json_encode($arrayName, JSON_PRETTY_PRINT);


	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

 ?>
