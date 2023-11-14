<?php

class Regisztral_Model
{
	public function get_data($vars)
	{
		$retData['eredmeny'] = "";
		try {
            if(isset($vars['csaladi_nev']) && isset($vars['utonev']) && isset($vars['bejelentkezes']) && isset($vars['jelszo']))
            {
                $conn = Database::getConnection();
                $sql = "INSERT INTO `felhasznalok`(`id`, `csaladi_nev`, `utonev`, `bejelentkezes`, `jelszo`, `jogosultsag`) VALUES ('',:csaladi_nev,:utonev,:bejelentkezes,:jelszo,'_1_');";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':csaladi_nev', $vars['csaladi_nev']);
                $stmt->bindParam(':utonev', $vars['utonev']);
                $stmt->bindParam(':bejelentkezes', $vars['bejelentkezes']);
                $hashedPassword = sha1($vars['jelszo']);
                $stmt->bindParam(':jelszo', $hashedPassword);
                
                if($stmt->execute())
                {
                    $sql = "select id, csaladi_nev, utonev, jogosultsag from felhasznalok where bejelentkezes='".$vars['bejelentkezes']."' and jelszo='".sha1($vars['jelszo'])."'";
                    $stmt = $conn->query($sql);
                    $felhasznalo = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    switch(count($felhasznalo)) {
                        case 0:
                            $retData['eredmeny'] = "ERROR";
                            $retData['uzenet'] = "Nem sikerült beléptetni. Szerver hiba.";
                            break;
                        case 1:
                            $retData['eredmény'] = "OK";
                            $retData['uzenet'] = "Kedves ".$felhasznalo[0]['csaladi_nev']." ".$felhasznalo[0]['utonev']."!<br><br>
                                                Sikeres regisztració. Jó munkát kívánunk rendszerünkkel.<br><br>
                                                Az üzemeltetők";
                            $_SESSION['userid'] =  $felhasznalo[0]['id'];
                            $_SESSION['userlastname'] =  $felhasznalo[0]['csaladi_nev'];
                            $_SESSION['userfirstname'] =  $felhasznalo[0]['utonev'];
                            $_SESSION['userlevel'] = $felhasznalo[0]['jogosultsag'];
                            Menu::setMenu();
                            break;
                        default:
                            $retData['eredmény'] = "ERROR";
                            $retData['uzenet'] = "Több felhasználót találtunk a megadott felhasználói név -jelszó párral!";
                    }
                }
            }
		}
		catch (PDOException $e) {
					$retData['eredmény'] = "ERROR";
					$retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
		}
		return $retData;
	}
}

?>