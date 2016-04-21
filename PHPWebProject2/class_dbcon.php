<?php

class dbcon
{
    private $con = NULL;
    
    public $errors = array(); 

    function connect(){
        require_once("config.php");
        $this->con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
    function close(){
        $this->con->close();
    }

    function getUserDetails($user)
	{
        $this->connect(); //verbinden
        if (!$this->con->connect_errno) { //db Verbindung funktioniert, wenn keine Fehler
		    if($user!=NULL) //Parameter nicht leer
		    {
                $userName = $this->con->real_escape_string($user); //SQL injection vermeiden
			    $sql = "SELECT * FROM benutzer
				    	WHERE b_login = '".$userName."'";
                $result = $this->con->query($sql);    //sql Query absetzen
                if ($result != NULL) {   //wir haben ein Ergebnis
                    $row = $result->fetch_object();   //erste Reihe auslesen
                    $this->close();
                    return ($row);
           } 
		}
        } else throw new Exception('Keine Datenbankverbindung');
        return NULL;
	}
	
	//Teilnehmer ID auslesen
	function getTNDetails($userid)
	{
        $this->connect(); //verbinden
        if (!$this->con->connect_errno) { //db Verbindung funktioniert, wenn keine Fehler
		    if($userid!=NULL) //Parameter nicht leer
		    {
			    $sql = "SELECT * FROM teilnehmer WHERE teilnehmer.tn_b_id = '".$userid."'";
                $result = $this->con->query($sql);    //sql Query absetzen
                if ($result != NULL) {   //wir haben ein Ergebnis
                    $row = $result->fetch_object();   //erste Reihe auslesen
                    $this->close();
                    return $row;
           } 
		}
        } else throw new Exception('Keine Datenbankverbindung');
        return NULL;
	}
	
	//Vortragender ID auslesen
	function getVTDetails($userid)
	{
        $this->connect(); //verbinden
        if (!$this->con->connect_errno) { //db Verbindung funktioniert, wenn keine Fehler
		    if($userid!=NULL) //Parameter nicht leer
		    {
			    $sql = "SELECT * FROM vortragender WHERE vortragender.vt_b_id = '".$userid."'";
                $result = $this->con->query($sql);    //sql Query absetzen
                if ($result != NULL) {   //wir haben ein Ergebnis
                    $row = $result->fetch_object();   //erste Reihe auslesen
                    $this->close();
                    return $row;
           } 
		}
        } else throw new Exception('Keine Datenbankverbindung');
        return NULL;
	}
	
	//Tabelle alle Teilnehmer
	function getTeilnehmer(){
		 $this->connect(); //verbinden
        if (!$this->con->connect_errno) {
			$sql = "select * from teilnehmer";
			$result = $this->con->query($sql);   
					$this->close();
                    return ($result);

		}else throw new Exception('Keine Datenbankverbindung');

	}

	//Tabelle alle Vortragende
	function getVortragende(){
		 $this->connect(); 
        if (!$this->con->connect_errno) {
			$sql = "select * from vortragender";
			$result = $this->con->query($sql);   
					$this->close();
                    return ($result);
		}else throw new Exception('Keine Datenbankverbindung');

	}
	
	//Tabelle alle Veranstaltungen
	function getVeranstaltungen(){
		$this->connect(); 
        if (!$this->con->connect_errno) {
			$sql = "select * from veranstaltungen va, vortragender vt where va.va_vt_id = vt.vt_id";
			$result = $this->con->query($sql);   
					$this->close();
                    return ($result);
		}else throw new Exception('Keine Datenbankverbindung');
	}
	
	//Tabelle alle VAs mit jeweiligem Vortragenden und allen Teilnehmern -> für admin
	function getVAwithVTandTN(){
		 $this->connect(); 
        if (!$this->con->connect_errno) {
			$sql = "SELECT va.va_titel, va.va_datum, va.va_typ, va.va_pdf, vt.vt_name, vt.vt_vorname, tn.tn_name, tn.tn_vorname FROM veranstaltungen va, vortragender vt, teilnehmer tn, tn_va tv 
					WHERE tv.va_id = va.va_id AND tv.tn_id = tn.tn_id AND va.va_vt_id = vt.vt_id";
			$result = $this->con->query($sql);   
					$this->close();
                    return ($result);
		}else throw new Exception('Keine Datenbankverbindung');
	}
	
	//Tabelle mit VAs von Vortragenden, je nachdem wer eingeloggt ist
	function getMyVAfromVT(){
		 $this->connect(); 
        if (!$this->con->connect_errno) {
			if (isset ($_SESSION['idvt'])){
			    $sql = "SELECT * FROM veranstaltungen va WHERE va.va_vt_id = ". $_SESSION['idvt'];
			$result = $this->con->query($sql);   
					$this->close();
                    return ($result);
		}else throw new Exception('Keine Datenbankverbindung');
		}
		return NULL;
	}
	
	//Tabelle mit VAs von Teilnehmer, je nachdem wer eingeloggt ist
	function getMyVAfromTN(){
		 $this->connect(); 
        if (!$this->con->connect_errno) {
			if (isset ($_SESSION['idtn'])){
			    $sql = "SELECT * FROM veranstaltungen va, tn_va tv WHERE va.va_id = tv.va_id AND tv.tn_id = ". $_SESSION['idtn'];
			    $result = $this->con->query($sql);   
					$this->close();
                    return ($result);
		}else throw new Exception('Keine Datenbankverbindung');
		}
		return NULL;
	}
 }
	

?>












