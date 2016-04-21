<?php
   session_start();
  
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin Login</title>
</head>
<body>
    <?php
    if (isset($_POST["send"])){
        require_once("class_login.php"); // login Klasse laden

        $login = new login(); //login Objekt erzeugen
        $error = $login->dologin(); //Methode f�r login aufrufen
		if (!isset($_SESSION["user"])) {    //irgendwas ist schiefgelaufen
            echo "Fehler:";
            foreach ($error as $err){
                echo "<p> $err </p>";
            }
			exit("<p><a href='index.php'>zurück zur Startseite</a></p>");
        }

        if ($_SESSION["level"] != 'admin'){
            $_SESSION = array(); //Zur Sicherheit Session-Array löschen
			session_destroy(); //Session löschen
			exit("<p>Sie haben keine Adminrechte!<br /><a href='userlogin.php'>Zum User-Login</a></p>");
		} else header("Location: adminhome.php");
    }
    ?>
    <form name="user" action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> 
    <p>
        <label>Username:</label>
        <input type="text" name="username" />
     </p>
     <p>
        <label>Passwort:</label>
        <input type="password" name="password" />
      </p>
      <p><input type = "submit" name = "send" value="Login" /></p>
    </form>


<p><a href="index.php">Zurück</a></p>

</body>
</html>
