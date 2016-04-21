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
<title>Alle Veranstaltungen</title>			
</head>
<body>
<p><h1>Alle Veranstaltungen</h1></p>

<?php
	$db = new dbcon();
	try{
		$res = $db->getVeranstaltungen();
		if ($res !== NULL){
				echo "<table border='1'>"; //Tabellenbeginn
				echo "<tr> <th>Name</th> <th>Datum</th><th>Typ</th><th>Info</th><th>Vortragende/r</th>"; //Überschrift
					while ($dsatz = $res->fetch_object()){
						echo "<tr>";
						echo "<td>" . $dsatz->va_titel . "</td>";
						echo "<td>" . $dsatz->va_datum . "</td>";
						echo "<td>" . $dsatz->va_typ . "</td>";
						echo "<td><a href='$dsatz->va_pdf'target='_blank'>PDF herunterladen</a></td>";
						echo "<td>" . $dsatz->vt_vorname . " ".$dsatz->vt_name ."</td>";
						echo "</tr>";
					}
				echo "</table>"; //Tabellenende 
		}else echo "Keine Veranstaltungen";
	} catch (Exception $e){
		echo $e->getMessage();
	}
?>

</body>
</html>


