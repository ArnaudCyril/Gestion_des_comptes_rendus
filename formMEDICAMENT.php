<?php
  require("lib/init.php");
  require("entete.html");
  require("sommaire.php");
  if (!estVisiteurConnecte())//Si visiteur non connecté
  {
        header("Location: connexion.php");  
  }
  unset($_SESSION['VisAVoir']);
 unset($_SESSION['sector']);
 unset($_SESSION['vis']);
?>
<html>
<head>
	<title>formulaire MEDICAMENT</title>

</head>
<iframe src="FormMedoc.php" width=77% height=600 />
</html>

<?php
  require("pied.html");
  require("fin.php");
?>
