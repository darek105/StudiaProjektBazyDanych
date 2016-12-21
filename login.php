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
		$password = 'test';

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
				$_SESSION['user_session'] = $row['IMIĘ'];
			}
			else{

				echo "Login lub hasło niepoprawne"; // wrong details
			}

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
?>
