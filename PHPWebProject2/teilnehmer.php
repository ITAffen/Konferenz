<?php
   session_start();
     include("class_dbcon.php");
     if (!isset($_SESSION["user"])){
         exit("<p>Sie haben keinen Zugriff</p><p><a href='index.php'>zur Startseite</a></p>");
     }
     include("navBar.php");
?>
<html>
<head>
<meta charset="utf-8">
<title>Alle Teilnehmer</title>
		
		
</head>
<body>
<p><h1>Alle Teilnehmer</h1></p>

<?php
	if (!isset ($_SESSION['user'])){
		exit("<p>Sie sind nicht eingeloggt!<br /><a href='index.php'>Zur Startseite</a></p>");
	}
	$db = new dbcon();
	try{
		$res = $db->getTeilnehmer();
		if ($res !== NULL){
			$num = $res->num_rows;
				echo "<table border='1'>"; //Tabellenbeginn
				echo "<tr> <td>Nachname</td> <td>Vorname</td>"; //Überschrift
					while ($dsatz = $res->fetch_object()){
						echo "<tr>";
						echo "<td>" . $dsatz->tn_name . "</td>";
						echo "<td>" . $dsatz->tn_vorname . "</td>";
						echo "</tr>";
					}
				echo "</table>"; //Tabellenende 
		}else echo "Keine Teilnehmer";
	} catch (Exception $e){
		echo $e->getMessage();
	}
?>

</body>
</html>
