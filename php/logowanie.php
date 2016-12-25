<?php

if(isset($_POST['btn-login'])) {

    $login = trim($_POST['login']);
    $user_password = trim($_POST['password']);

    $password = $user_password;

    try {

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

 ?>
