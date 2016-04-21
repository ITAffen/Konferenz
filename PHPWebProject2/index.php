<?php
   session_start();
?>
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
		<title>Startseite</title>
	</head>
	<body>
<?php
        if(!isset($_SESSION['user'])){

?>
		<p><h1 style="text-align: center;">Herzlich willkommen bei Konferenz GmbH!</h1></p>
		<p style="text-align: center;"><a href="userlogin.php">Zum Login</a></p>
		<p style="text-align: center;"><a href="adminlogin.php">Zum Admin Login</a></p>
<?php } else
            if($_SESSION['level'] == 'admin'){
                header("Location: adminhome.php");
            } else 
                header("Location: userhome.php");
?>
	</body>
</html>
