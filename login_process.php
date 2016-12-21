<?php
	session_start();
	// require_once 'dbconfig.php';


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

	if(isset($_POST['btn-login']))
	{
		//$user_name = $_POST['user_name'];
		$login = trim($_POST['login']);
		$user_password = trim($_POST['password']);

		$password = $user_password;
		// $password = 'test';

		try
		{
			$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
			$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $db_con->prepare("SELECT * FROM pracownicy WHERE PESEL=:login");
			$stmt->execute(array(":login"=>$login));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();

			if($row['HASŁO']==$password){

				echo "ok"; // log in
				$_SESSION['user_session'] = $row['PESEL'];
			}
			else{

				echo "Login lub hasło niepoprawne"; // wrong details
			}

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	if(isset($_POST['btn-search-produkt']))
	{
		//$user_name = $_POST['user_name'];
		$indeks = trim($_POST['indeks']);
		$id_produktu = trim($_POST['wszystko']);
		// $user_password = trim($_POST['password']);
		//
		// $password = $user_password;
		// // $password = 'test';
		if ($id_produktu != "") {
			try
			{
				$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
				$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $db_con->prepare("SELECT * FROM produkty WHERE INDEKS=:indeks");
				$stmt->execute(array(":indeks"=>$indeks));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				// $count = $stmt->rowCount();

				$stmt1 = $db_con->prepare("SELECT * FROM lokalizacja WHERE ID_PRODUKTU=:id_produktu");
				$stmt1->execute(array(":id_produktu"=>$id_produktu));
				$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
				// $count1 = $stmt1->rowCount();

				if($row['INDEKS'] != ""){ //zrobic JSON


					$arrayName = array('indeks' =>  $row['INDEKS'],
														 'nazwa'  =>  $row['NAZWA'],
														 'cena'  =>  $row['CENA'],
														 'rodzaj'  =>  $row['RODZAJ_CENY'],
														 'ilosc'  =>  $row1['ILOŚĆ'],
													 );
					echo json_encode($arrayName, JSON_PRETTY_PRINT);
				}
				else{
					echo "Login lub hasło niepoprawne"; // wrong details
				}

			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		} else {
			try
			{
				$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
				$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $db_con->prepare("SELECT * FROM produkty WHERE INDEKS=:indeks");
				$stmt->execute(array(":indeks"=>$indeks));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$count = $stmt->rowCount();

				if($row['INDEKS'] != ""){ //zrobic JSON


					$arrayName = array('indeks' =>  $row['INDEKS'],
														 'nazwa'  =>  $row['NAZWA'],
														 'cena'  =>  $row['CENA'],
														 'rodzaj'  =>  $row['RODZAJ_CENY'],
														 'ilosc' => 'brak'
													 );
					echo json_encode($arrayName, JSON_PRETTY_PRINT);
				}
				else{
					echo "Login lub hasło niepoprawne"; // wrong details
				}

			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}



	}

	if(isset($_POST['model']))
	{
		$indeks = trim($_POST['indeks']);
		$id_produktu = trim($_POST['wszystko']);
		// $user_password = trim($_POST['password']);
		//
		// $password = $user_password;
		// // $password = 'test';
		if ($id_produktu != "") {
			try
			{
				$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
				// $db_con1 = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
				$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $db_con->prepare("SELECT * FROM asortyment WHERE INDEKS=:indeks");
				$stmt->execute(array(":indeks"=>$indeks));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				// $count = $stmt->rowCount();
				// $arrayName = "";
				// $array[] = "";

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

				$id_produktu = $row['INDEKS'] . $row['KOLOR'] . $row['ROZMIAR'];
				$stmt1 = $db_con->prepare("SELECT * FROM lokalizacja WHERE ID_PRODUKTU=:id_produktu");
				$stmt1->execute(array(":id_produktu"=>$id_produktu));
				$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
				// $count1 = $stmt1->rowCount();


			if($row['INDEKS'] != ""){ //zrobic JSON


				$arrayName = array('indeks' =>  $row['INDEKS'],
													 'kolor'  =>  $row['KOLOR'],
													 'rozmiar'  =>  $row['ROZMIAR'],
													 'ilosc'  =>   $row1['ILOŚĆ'],
													 'gdzie' =>  $row1['ID_ODDZIAŁU'],
												 );
				$array[] = $arrayName;
			}
			else{
				echo "Coś poszło nie tak"; // wrong details
			}
		}
		echo json_encode($array, JSON_PRETTY_PRINT);


			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
	}
}

// 	if(isset($_POST['paczki']))
// 	{
// 		// $indeks = trim($_POST['indeks']);
// 		// $id_produktu = trim($_POST['wszystko']);
// 		// // $user_password = trim($_POST['password']);
// 		// //
// 		// $password = $user_password;
// 		// // $password = 'test';
// 			try
// 			{
// 				$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
// 				// $db_con1 = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
// 				$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 				$stmt = $db_con->prepare("SELECT * FROM paczki");
// 				$row = $stmt->fetch(PDO::FETCH_ASSOC);
// 				// $count = $stmt->rowCount();
// 				// $arrayName = "";
// 				$array[] = "";
//
// 		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//
// 				// $id_produktu = $row['INDEKS'] . $row['KOLOR'] . $row['ROZMIAR'];
// 				// $stmt1 = $db_con->prepare("SELECT * FROM paczki");
// 				// // $stmt1->execute(array(":id_produktu"=>$id_produktu));
// 				// $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
// 				// // $count1 = $stmt1->rowCount();
//
//
// 			// if($row['ID_PACZKI'] != ""){ //zrobic JSON
//
//
// 				$arrayName = array('id_paczki' =>  $row['ID_PACZKI'],
// 													 'data_w'  =>  $row['DATA_WYSŁANIA'],
// 													 'data_p'  =>  $row['DATA_PRZYJĘCIA'],
// 													 'departament'  =>   $row1['DEPARTAMENT'],
// 													 'ilosc_pro' =>  $row1['ILOSC_PORODUKTÓW'],
// 												 );
// 				$array[] = $arrayName;
// 			// }
// 			// else{
// 			// 	echo "Coś poszło nie tak"; // wrong details
// 			// }
// 		}
// 		echo json_encode($array, JSON_PRETTY_PRINT);
//
//
// 			}
// 			catch(PDOException $e){
// 				echo $e->getMessage();
// 			}
// }
//
//






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
			// $stmt = $db_con->prepare("SELECT * FROM paczki");
			// $stmt->execute();
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
			// $stmt = $db_con->prepare("SELECT * FROM paczki");
			// $stmt->execute();
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





if(isset($_POST['formToChangeDane']))
{
	try
	{

			$pesel = $_POST['pesel-change'];
			$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);

			//zrobic przpadki na ify

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
// dodajPracownika

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


			$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
			$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $db_con->prepare("INSERT INTO pracownicy (PESEL, IMIĘ, NAZWISKO, STANOWISKO, TELEFON, ID_ODDZIAŁU, HASŁO) VALUES (:pesel, :imie, :nazwisko, :stanowisko, :telefon, :oddzial, :haslo)");
			$stmt->execute(array(":pesel"=>$pesel, ':imie'=>$imie, ':nazwisko'=>$nazwisko, ':stanowisko'=>$stanowisko, ':telefon'=>$telefon, ':oddzial'=>$oddzial, ':haslo'=>$haslo));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);


			$stmt1 = $db_con->prepare("SELECT * FROM pracownicy WHERE PESEL=:pesel");
			$stmt1->execute(array(":pesel"=>$pesel));
			$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
			$count1 = $stmt1->rowCount();

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


?>
