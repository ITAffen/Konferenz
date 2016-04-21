<?php
   session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>User Login</title>
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
                echo "<p>$err </p>";
            }
            exit("<p><a href='index.php'>zurück zur Startseite</a></p>");
        } else header("Location: userhome.php");
         
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
	
<p><a href="index.php">Zurück zur Startseite</a></p>

</body>
</html>