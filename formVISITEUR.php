<?php
  require("lib/init.php");
  require("entete.html");
  require("sommaire.php");
  if (!estVisiteurConnecte())//Si visiteur non connecté
  {
        header("Location: connexion.php");  
  }
  unset($_SESSION['VisAVoir']);
 
?>

  <html>
<head>
	<title>formulaire VISITEUR</title>
	
</head>
<body>

  <!-- Division principale -->
 <iframe src="FormVis.php" width=70% height=600 />
</body>
</html>
<?php
  require("pied.html");
  require("fin.php");
?>
