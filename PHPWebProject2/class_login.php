<?php

class login
{
    public $errors = array();

    public function __construct() //Konstruktor
    {
        require_once("class_dbcon.php");
    }

    //einloggen 

    public function dologin()
    {     
        // check login form contents
        if (empty($_POST['username'])) {
            $this->errors[] = "Usernamen angeben";
        } 
        if (empty($_POST['password'])) {
            $this->errors[] = "Passwort angeben";
        }

        if (count($this->errors) == 0){
            
            $db = new dbcon();
            try {
                $userdetails = $db->getUserDetails($_POST['username']);
                if ($userdetails != NULL){ //
                    if ($_POST['password'] == $userdetails->b_passwort){
                        //Passwort sollte natürlich eigentlich verschlüsselt gespeichert sein und mit hash verglichen werden
                        $_SESSION['user'] = $userdetails->b_login; //username in php session schreiben
						$_SESSION['level'] = $userdetails->b_level;
						if ($_SESSION['level'] == 'teilnehmer'){
                            $tnDetails = $db->getTNDetails($userdetails->b_id);
                            $_SESSION['idtn'] = $tnDetails->tn_id;
						    $_SESSION["name"] = $tnDetails->tn_vorname." ".$tnDetails->tn_name;
						}
						if ($_SESSION['level'] == 'vortragender'){
                            $vtDetails = $db->getVTDetails($userdetails->b_id);
						    $_SESSION['idvt'] = $vtDetails->vt_id;
                            $_SESSION["name"] = $vtDetails->vt_vorname." ".$vtDetails->vt_name;
						}
						
                    } else {
                        $this->errors[] = "Username oder Passwort falsch.";  //Passwort falsch
                    }
                }
                else {
                    $this->errors[] = "Username oder Passwort falsch.";  //user existiert nicht
                }
            }
            catch (Exception $e) {
                $this->errors[] = $e->getMessage();
            }
        }
        return $this->errors;

    }


    public function dologout()
    {
        $_SESSION = array(); //Zur Sicherheit Session-Array löschen
        session_destroy(); //Session löschen
    }
}
?>