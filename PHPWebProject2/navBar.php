
<nav class='navbar'>
    <a href="index.php">Home</a>

    <a href="veranstaltungen.php">Veranstaltungen</a>

    <a href="vortragende.php">Vortragende</a>

    <a href="teilnehmer.php">Teilnehmer</a>

    <a href="meineinhalte.php">Meine Inhalte</a>
    <?php if(isset($_SESSION["user"])) { //check if user is logged in ?>

    <a href="logout.php">Logout</a>

    <?php } else{ ?>

                <a href="userlogin.php">Login</a>

    <?php }
          if (!isset($_SESSION["level"]) || $_SESSION["level"] != 'admin'){?>

                <a href="adminlogin.php">AdminLogin</a>
    <?php } ?>

</nav>
