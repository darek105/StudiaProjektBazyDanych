<?php

if(isset($_POST['btn-search-produkt']))
{

  $indeks = trim($_POST['indeks']);
  $id_produktu = trim($_POST['wszystko']);

  if ($id_produktu != "") {

          try
          {
              $stmt = $db_con->prepare("SELECT * FROM produkty WHERE INDEKS=:indeks");
              $stmt->execute(array(":indeks"=>$indeks));
              $row = $stmt->fetch(PDO::FETCH_ASSOC);

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
          $stmt = $db_con->prepare("SELECT * FROM produkty WHERE INDEKS=:indeks");
          $stmt->execute(array(":indeks"=>$indeks));
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

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




////DLA MODELU



if(isset($_POST['model']))
{
      $indeks = trim($_POST['indeks']);
      $id_produktu = trim($_POST['wszystko']);

      if ($id_produktu != "") {

            try {

                    $stmt = $db_con->prepare("SELECT * FROM asortyment WHERE INDEKS=:indeks");
                    $stmt->execute(array(":indeks"=>$indeks));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $id_produktu = $row['INDEKS'] . $row['KOLOR'] . $row['ROZMIAR'];
                    $stmt1 = $db_con->prepare("SELECT * FROM lokalizacja WHERE ID_PRODUKTU=:id_produktu");
                    $stmt1->execute(array(":id_produktu"=>$id_produktu));
                    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

                    if($row['INDEKS'] != ""){

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


//DODAWANIE PRODUKTU

if(isset($_POST['dodajProduct']))
{
	try
	{

			$indeks = trim($_POST['indeks']);
			$nazwa = trim($_POST['nazwa']);
			$cena = trim($_POST['cena']);
			$rodzaj_ceny = trim($_POST['rodzaj_ceny']);
			$kolor = trim($_POST['kolor']);
			$rozmiar = trim($_POST['rozmiar']);
			$ilosc = intval($_POST['ilosc']);
			$oddzial = trim($_POST['oddzial']);
			$id_produktu = $indeks . $kolor .	$rozmiar;
			$id_kupna = strval(round(100,1000) . $oddzial);


			$stmt = $db_con->prepare("INSERT INTO produkty (INDEKS, NAZWA, RODZAJ_CENY, CENA) VALUES (:indeks, :nazwa, :rodzaj_ceny, :cena)");
			$stmt->execute(array(":indeks"=>$indeks, ':nazwa'=>$nazwa, ':rodzaj_ceny'=>$rodzaj_ceny, ':cena'=>$cena));

			$stmt = $db_con->prepare("INSERT INTO asortyment (INDEKS, KOLOR, ROZMIAR, ID_PRODUKTU) VALUES (:indeks, :kolor, :rozmiar, :id_produktu)");
			$stmt->execute(array(":indeks"=>$indeks, ':kolor'=>$kolor, ':rozmiar'=>$rozmiar, ':id_produktu'=>$id_produktu));

			$stmt1 = $db_con->prepare("INSERT INTO lokalizacja (ID_KUPNA, ID_ODDZIAŁU, ID_PRODUKTU, ILOŚĆ) VALUES (:id_kupna, :id_oddzialu, :id_produktu, :ilosc)");
			$stmt1->execute(array(":id_kupna"=>$id_kupna, ':id_oddzialu'=>$oddzial, ':id_produktu'=>$id_produktu, ':ilosc'=>$ilosc));

				echo "OK"; //JESLI COS POJDZIE NIE TAK TO TRY CATCH ZWROCI BLAD

	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}



 ?>
