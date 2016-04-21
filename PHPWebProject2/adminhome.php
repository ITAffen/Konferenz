<?php
   session_start();
   if (!isset($_SESSION['user']) || $_SESSION['level'] != 'admin'){
       exit("<p>Sie haben keinen Zugriff</p><p><a href='index.php'>zur Startseite</a></p>");
   }
   include("navBar.php");
?>
<html>
<head>
<meta charset="utf-8">
<title>Admin-Home</title>
		
			
</head>
<body>
<?php
echo "<p><h1>Willkommen bei Konferenz GmbH!</h1></p>";
echo "\n Willkommen Admin ".$_SESSION["user"]; //Benutzer begrüßen
echo "<p><a href='meineinhalte.php'>meine Inhalte</a></p>";
?>
</body>
</html>
















