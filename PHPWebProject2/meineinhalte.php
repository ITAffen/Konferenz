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
<title>Meine Inhalte</title>
</head>
<body>
<?php

	
    echo "<p><h1>Meine Inhalte</h1></p>";
	
	if ($_SESSION['level'] == 'admin'){
	$db = new dbcon();
	try{
		$res = $db->getVAwithVTandTN();
		if ($res !== NULL){
			$num = $res->num_rows;
				echo "<table border='1'>"; //Tabellenbeginn
				echo "<tr> <td>Veranstaltung</td> <td>Datum</td><td>Typ</td><td>Info</td><td>Vortragende/r</td><td>Teilnehmer</td>"; //Überschrift
					while ($dsatz = $res->fetch_object()){
						echo "<tr>";
						echo "<td>" . $dsatz->va_titel . "</td>";
						echo "<td>" . $dsatz->va_datum . "</td>";
						echo "<td>" . $dsatz->va_typ . "</td>";
						echo "<td><a href='$dsatz->va_pdf'target='_blank'>PDF herunterladen</a></td>";
						echo "<td>" . $dsatz->vt_vorname . " ".$dsatz->vt_name ."</td>";
						echo "<td>" . $dsatz->tn_vorname . " ".$dsatz->tn_name ."</td>";
						echo "</tr>";
					}
				echo "</table>"; //Tabellenende 
				echo "<p><a href='adminhome.php'>zurück</a></p>";
		}else echo "Keine Veranstaltungen";
	} catch (Exception $e){
		echo $e->getMessage();
	}
   } 
	else if ($_SESSION['level'] == 'vortragender'){
		$db = new dbcon();
	try{
		$res = $db->getMyVAfromVT();
		if ($res !== NULL){
			$num = $res->num_rows;
            echo "<table border='1'>"; //Tabellenbeginn
				echo "<tr> <td>Veranstaltung</td> <td>Datum</td><td>Typ</td><td>Info</td>"; //Überschrift
					while ($dsatz = $res->fetch_object()){
						echo "<tr>";
						echo "<td>" . $dsatz->va_titel . "</td>";
						echo "<td>" . $dsatz->va_datum . "</td>";
						echo "<td>" . $dsatz->va_typ . "</td>";
						echo "<td><a href='$dsatz->va_pdf'target='_blank'>PDF herunterladen</a></td>";
						echo "</tr>";
					}
				echo "</table>"; //Tabellenende 
				echo "<p><a href='userhome.php'>zurück</a></p>";
		}else echo "Keine Veranstaltungen";
	} catch (Exception $e){
		echo $e->getMessage();
	}
	}
	else{
		$db = new dbcon();
	try{
		$res = $db->getMyVAfromTN();
		if ($res !== NULL){
			$num = $res->num_rows;
            echo "<table border='1'>"; //Tabellenbeginn
				echo "<tr> <td>Veranstaltung</td> <td>Datum</td><td>Typ</td><td>Info</td>"; //Überschrift
					while ($dsatz = $res->fetch_object()){
						echo "<tr>";
						echo "<td>" . $dsatz->va_titel . "</td>";
						echo "<td>" . $dsatz->va_datum . "</td>";
						echo "<td>" . $dsatz->va_typ . "</td>";
						echo "<td><a href='$dsatz->va_pdf'target='_blank'>PDF herunterladen</a></td>";
						echo "</tr>";
					}
				echo "</table>"; //Tabellenende 
				echo "<p><a href='userhome.php'>zurück</a></p>";
		}else echo "Keine Veranstaltungen";
	} catch (Exception $e){
		echo $e->getMessage();
	}
	}
  
?>

</body>
</html>
















