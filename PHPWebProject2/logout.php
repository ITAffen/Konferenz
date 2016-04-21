<?php
session_start();
?>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Logout</title>	
</head>
	<body>
		<?php
			require_once("class_login.php");
			$login = new login();
			$res = $login->dologout();
			if (!isset($_SESSION["user"]))
				echo "Sie wurden ausgeloggt!";
				echo "<p><a href='index.php'>zur Startseite</a></p>";  
		?>
	</body>
</html> 