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
<title>Alle Vortragende</title>

</head>
<body>
<p><h1>Alle Vortragende</h1></p>

<?php

$db = new dbcon();
try{
    $res = $db->getVeranstaltungen();
    if ($res !== NULL){
        echo "<table border='1'>"; //Tabellenbeginn
        echo "<tr> <th>Vortragende/r</th> <th>E-Mail</th><th>Veranstaltung</th><th>Datum</th>"; //Überschrift
        while ($dsatz = $res->fetch_object()){
            echo "<tr>";
            echo "<td>" . $dsatz->vt_vorname . " ".$dsatz->vt_name ."</td>";
            echo "<td>" . $dsatz->vt_email . "</td>";
            echo "<td>" . $dsatz->va_titel . "</td>";
            echo "<td>" . $dsatz->va_datum . "</td>";
            echo "</tr>";
        }
        echo "</table>"; //Tabellenende
    }else echo "Keine Vortragenden";
}
catch (Exception $e){
    echo $e->getMessage();
}
?>


</body>
</html>
