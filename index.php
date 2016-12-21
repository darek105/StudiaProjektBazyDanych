<?php

/*
Author: Pradeep Khodke
URL: http://www.codingcage.com/
*/


session_start();

if(isset($_SESSION['user_session'])!="")
{
	header("Location: home.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LOGIN</title>
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
<link rel="stylesheet" href="css/master.css">


</head>

<body>

<section>
		<div class="wrapper">
				<div class="title">
						<h1>PANEL LOGIN</h1>
				</div>
				<div class="border ">
					<div class="form effect ">
							<div class="title_panel">
								<h4>Logowanie do systemu</h4>
							</div>
							<div class="box-from">
								<form class="" method="post" id="login-form">
										<div id="login">
												<label for="login">Login:</label>
												<input type="text" name="login" placeholder="770825641121"  id="login">
												<span id="check-e"></span>
										</div>
										<div id="password">
												<label for="password">Hasło:</label>
												<input type="password" name="password" placeholder="haslo" id="password">
										</div>
										<div id="submit">
												<input type="submit" name="btn-login" value="LOGIN" id="btn-login">
										</div>
										<div id="error">
										<!-- error will be shown here ! -->
										</div>
										<div id="remember">
												<span>Nie pamiętasz hasła?</span>
										</div>
								</form>
							</div>
					</div>
				</div>
		</div>
</section>

<script type="text/javascript" src="js/script.js"></script>


</body>
</html>
