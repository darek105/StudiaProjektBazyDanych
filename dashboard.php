<?php
session_start();

if(!isset($_SESSION['user_session']))
{
	header("Location: index.php");
}

require_once 'php/connectDB.php';

$stmt = $db_con->prepare("SELECT * FROM pracownicy WHERE PESEL=:pesel"); //email bo z index.php
$stmt->execute(array(":pesel"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>PANEL ADMIN</title>
        <!-- <link href="style.css" rel="stylesheet" media="screen"> -->
        <link rel="stylesheet" href="css/master_sys.css">

    </head>

    <body>

        <section>
            <div class="wrapper-menu-left">
                <div class="menu_header">
                    <div class="search">
                        <img src="img/search.png" alt="" />
                        <input type="text" name="search" placeholder="Search">
                    </div>
                    <div class="user">
                        <img src="img/avatar.png" alt="" />
                        <h1> <?php echo $row['IMIĘ']; ?></h1>
                        <!-- <h1 style="display:none;"> <?php echo $row['PESEL']; ?></h1> -->
                    </div>
                    <div class="menu_item">
                        <div class="line-style-black">
                            <h1>MENU</h1>
                        </div>
                        <ul>
                            <li>
                                <a href="#"><img src="img/home.png" alt="" />HOME</a>
                            </li>
                            <li>
                                <a href="#"><img src="img/product.png" alt="" />PRODUKTY</a>
                            </li>
                            <li class="premium-menu"w>
                                <a href="#"><img src="img/dodaj.png" alt="" />DODAJ PRODUKTY</a>
                            </li>
                            <li>
                                <a href="#"><img src="img/paczki.png" alt="" />PACZKI</a>
                            </li>
                            <li>
                                <a href="#"><img src="img/team.png" alt="" />TEAM</a>
                            </li>
                            <li class="premium-menu">
                                <a href="#"><img src="img/dodaj.png" alt="" />DODAJ OSOBE</a>
                            </li>
                            <li class="premium-menu">
                                <a href="#"><img src="img/dodaj.png" alt="" />USUŃ OSOBE</a>
                            </li>
                            <li>
                                <a href="#"><img src="img/profil.png" alt="" />PROFIL</a>
                            </li>
                            <li>
                                <a href="logout.php" alt="" /><img src="img/wyloguj.png" alt="" />WYLOGUJ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="content">

                <div id="home">
                    <p>
                        welcome in dashbord!!!
                    </p>
                    <p>
                        chose something of menu
                    </p>
                </div>

                <div id="id_produkt">
                    <div class="input-to-search">
                        <div class="title">
                            <img src="img/ubranie1.png" alt="">
                            <h1>WPISZ DANE DLA PRODUKTU</h1>
                        </div>
                        <form method="post" id="form-to-search">
                            <div class="">
                                <input type="text" name="indeks" id="id_produkt1" placeholder="INDEKS">
                            </div>
                            <div class="">
                                <input type="text" name="kolor" id="id_produkt2" placeholder="KOLOR">
                            </div>
                            <div class="">
                                <input type="text" name="rozmiar" id="id_produkt3" placeholder="ROZMIAR">
                            </div>
                            <div class="" style="display:none">
                                <input type="text" name="wszystko" id="id_produkt4">
                            </div>
                            <div class="">
                                <input type="submit" name="btn-search-produkt" id="btn-search-produkt" value="SZUKAJ">
                            </div>
                        </form>
                    </div>
                    <div id="content-id-produkt">
                        <div class="box-left">
                            <div class="btn-content-produkty">
                                <form method="post" id="model-form">
                                    <input type="text" name="indeks" id="id_produkt5">
                                    <input type="text" name="kolor" id="id_produkt6">
                                    <input type="text" name="rozmiar" id="id_produkt7">
                                    <input type="text" name="wszystko" id="id_produkt8">
                                    <input type="submit" name="model" id="model" value="model">
                                </form>
                                <form method="post" id="zapas-form">
                                    <input type="submit" name="zapas" value="ZAPAS W SALONACH">
                                </form>
                                <span>Podaj więcej szczegołow !!!</span>
                            </div>
                            <div class="tab-produkt">
                                <div class="indeks-produkt">
                                    <span>INDEKS:</span>
                                    <span class="idxp"></span>
                                </div>
                                <div class="nazwa-produkt">
                                    <span>NAZWA:</span>
                                    <span class="nza"></span>
                                </div>
                                <div class="cena-produkt">
                                    <span>CENA:</span>
                                    <span class="money"></span>
                                </div>
                                <div class="rodzaj-produkt">
                                    <span>RODZAJ CENY:</span>
                                    <span class="money_rodzaj"></span>
                                </div>
                            </div>
                        </div>
                        <div class="box-right">
                            <div class="ilosc-produkt">
                                <span>ILOŚC PRODUKTOW:</span>
                                <span class="ilosc_pro"></span>
                            </div>
                        </div>
                        <div class="tab-produkt-model">
                            <div class="btn-content-produkty">
                                <span>MODEL: </span>
                                <span></span>
                            </div>
                            <table id="model-tab">
                                <tr>
                                    <th>INDEKSY</th>
                                    <th>KOLOR</th>
                                    <th>ROZMIAR</th>
                                    <th>ILOSC DOSTĘPNYCH</th>
                                    <th>ODDZIAŁ</th>
                                </tr>

                                <!--   echo "<tr>";
								      echo "<td>" . $row['PESEL'] . "</td>";
								      echo "<td>" . $row['IMIĘ'] . "</td>";
								      echo "<td>" . $row['NAZWISKO'] . "</td>";
								      echo "<td>" . $row['STANOWISKO'] . "</td>";
								      echo "<td>" . $row['TELEFON'] . "</td>";
								      echo "<td>" . $row['ID_ODDZIAŁU'] . "</td>";
								      echo "</tr>"; -->
                            </table>
                        </div>
                    </div>
                </div>


                <div id="profil-admin-produkt" style="text-align:center;">
                    <img src="img/dodajBig.png" alt="">
                    <div class="form-ProductAdd">
                        <form class="" method="post" id="addProductAdmin">
                            <div class="indeks">
                                <span>INDEKS</span>
                                <input type="text" name="indeks" required>
                            </div>
                            <div class="nazwa">
                                <span>NAZWA</span>
                                <input type="text" name="nazwa" required>
                            </div>
                            <div class="cena">
                                <span>CENA</span>
                                <input type="text" name="cena" required>
                            </div>
                            <div class="rodzaj_ceny">
                                <span>RODZAJ CENY</span>
                                <input type="text" name="rodzaj_ceny" required>
                            </div>
                            <div class="kolor">
                                <span>KOLOR</span>
                                <input type="text" name="kolor" required>
                            </div>
                            <div class="rozmiar">
                                <span>ROZMIAR</span>
                                <input type="text" name="rozmiar" required>
                            </div>
                            <!-- <div class="pesel-profil">
									<span>PESEL</span>
									<input type="text" name="pesel" required> // id_productu
								</div> -->
                            <div class="ilosc">
                                <span>ILOŚĆ</span>
                                <input type="text" name="ilosc" required>
                            </div>
                            <div class="oddzial">
                                <span>ODDZIAŁ</span>
                                <input type="text" name="oddzial" required>
                            </div>
                            <div class="submit">
                                <input type="submit" name="dodajProduct" value="DODAJ PRODUCT">
                            </div>
                        </form>
                        <span id="okAddProduct"></span>
                    </div>
                </div>

                <div id="id_paczki">
                    <div class="input-to-search">
                        <div class="title">
                            <img style="margin-top:15px;" src="img/paczka.png" alt="">
                            <h1>WSZYSTKIE PACZKI</h1>
                        </div>
                    </div>
                    <form method="post" id="paczki-form">
                        <input type="submit" name="paczki" id="submit-paczka" value="POKAZ">
                    </form>
                    <div id="content-id-paczki">
                        <div class="tab-produkt-model paczki">
                            <table id="paczki-tab">
                                <tr>
                                    <th>ID</th>
                                    <th>DATA WYSŁANIA</th>
                                    <th>DATA PRZYJĘCIA</th>
                                    <th>DEPARTAMENT</th>
                                    <th>ILOŚC PRODUKTOW</th>
                                </tr>
                                <!-- Wypisywanie danych z bazy danych  -->
                            </table>
                        </div>
                    </div>
                    <form method="post" id="details-paczki-form">
                        <input type="text" name="paczka-details" id="details-paczka" placeholder="Podaj id">
                        <input type="submit" name="paczki-details" id="details-ubmit-paczka" value="POKAZ">
                    </form>
                    <div class="tab-produkt-model paczki-details">
                        <table id="paczki-tab-details">
                            <tr>
                                <th>ID PACZKI</th>
                                <th>ID PRODUKTU</th>
                                <th>ILOSC PRODUKTOW</th>
                            </tr>
                            <!-- Wypisywanie danych z bazy danych  -->
                        </table>
                    </div>
                </div>

                <div id="team" style="text-align:center;">
                    <img style="margin: 40px auto; display:block" src="img/bigTeam.png" alt="">
                    <div class="error-team">
                        <p>Nie masz wszystkich uprawinien do wyswietlenia danych zespolu</p>
                    </div>
                    <form method="post" id="team-form">
                        <input class="pokaz" type="submit" name="team" id="submit-team" value="POKAZ">
                    </form>
                    <div class="tab-team team-details">
                        <table id="team-tab">
                            <tr>
                                <th>IMIĘ</th>
                                <th>NAZWISKO</th>
                                <th>PESEL</th>
                                <th>STANOWISKO</th>
                                <th>TELEFON</th>
                                <th>ODDZIAŁ</th>
                            </tr>
                            <!-- Wypisywanie danych z bazy danych  -->
                        </table>
                    </div>
                </div>


                <div id="profil">
                    <div class="tab-span span-details">
                        <div class="imie-profil">
                            <span>IMIĘ</span>
                            <span><?php echo $row['IMIĘ']; ?></span>
                        </div>
                        <div class="nazwisko-profil">
                            <span>NAZWISKO</span>
                            <span><?php echo $row['NAZWISKO']; ?></span>
                        </div>
                        <div class="stanowisko-profil">
                            <span>STANOWISKO</span>
                            <span><?php echo $row['STANOWISKO']; ?></span>
                        </div>
                        <div class="telefon-profil">
                            <span>TELEFON</span>
                            <span><?php echo $row['TELEFON']; ?></span>
                        </div>
                        <div class="haslo-profil">
                            <span>HASŁO</span>
                            <span><?php echo $row['HASŁO']; ?></span>
                        </div>

                    </div>




                    <div class="zmien-dane">
                        <div class="PokazFormDoZmiany">
                            <button type="button" name="button">ZMIEŃ DANE</button>
                        </div>
                        <select class="dane" name="dane">
								<option value="IMIĘ">imie</option>
								<option value="NAZWISKO">nazwisko</option>
								<option value="STANOWISKO">stanowisko</option>
								<option value="TELEFON">telefon</option>
								<option value="HASLO">hasło</option>
							</select>
                        <div class="ToChangeDane">
                            <form method="post" id="formToChangeDane">
                                <input type="text" name="imie" value="">
                                <input type="text" name="pesel-change" value="" style="display:none;">
                                <input type="submit" name="formToChangeDane" id="formToChangeDane-submit" value="ZMIEŃ">
                            </form>
                        </div>
                    </div>
                    <span id="okChange"></span>
                </div>


                <div id="team-delete" style="text-align:center;">
                    <div class="form-DeletePerson">
                        <form class="" method="post" id="deletePerson">
                            <div class="indeks">
                                <span>IMIĘ</span>
                                <input type="text" name="imie" required>
                            </div>
                            <div class="nazwa">
                                <span>NAZWISKO</span>
                                <input type="text" name="nazwisko" required>
                            </div>
                            <div class="cena">
                                <span>PESEL</span>
                                <input type="text" name="pesel" required>
                            </div>
                            <div class="YesOrNot">
                                <button type="button" id="usunOsobe" name="usunOsobe">USUŃ</button>
                            </div>
                            <div class="submit">
                                <label for="">Czy na pewno chesz usunąc tą osobe?</label>
                                <div class="check">
                                    <input type="submit" name="yesDelete" value="TAK">
                                    <button type="button" id="noDelete" name="Nie">NIE</button>
                                </div>
                            </div>
                        </form>
                        <span id="okDeletePerson"></span>
                    </div>
                </div>

                <div id="profil-admin" style="text-align:center;">
                    <img src="img/dodajBig.png" alt="">
                    <div class="form-daneAdd">
                        <form class="" method="post" id="addPresonAdmin">
                            <div class="imie-profil">
                                <span>IMIĘ</span>
                                <input type="text" name="imie" required>
                            </div>
                            <div class="nazwisko-profil">
                                <span>NAZWISKO</span>
                                <input type="text" name="nazwisko" required>
                            </div>
                            <div class="imie-profil">
                                <span>STANOWISKO</span>
                                <input type="text" name="stanowisko" required>
                            </div>
                            <div class="pesel-profil">
                                <span>PESEL</span>
                                <input type="text" name="pesel" required>
                            </div>
                            <div class="telefon-profil">
                                <span>TELEFON</span>
                                <input type="text" name="telefon" required>
                            </div>
                            <div class="oddzial-profil">
                                <span>ODDZIAŁ</span>
                                <input type="text" name="oddzial" required>
                            </div>
                            <div class="imie-profil">
                                <span>HASŁO</span>
                                <input type="text" name="hasło" required>
                            </div>
                            <div class="submit">
                                <input type="submit" name="dodajPracownika" value="DODAJ OSOBE">
														</div>
                        </form>
                        <span id="okAddPreson"></span>
                    </div>
                </div>

            </div>
        </section>

        <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
        <script type="text/javascript" src="js/validation.min.js"></script>
        <script type="text/javascript">
            function checkPreson() {
                var count = '<?php echo $row['TELEFON']; ?>'

                var specialMore = ['661124460', '519772034', '608726669'];

                for (var i = 0; i < specialMore.length; i++) {
                    if (count == specialMore[i]) return true;
                }
                return false;
            }
            $('#formToChangeDane input').eq(1).val("<?php echo $row['PESEL']; ?>");
        </script>
        <script src="js/custom_js.js" charset="utf-8"></script>

    </body>

    </html>
