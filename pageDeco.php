<?php
  require("lib/init.php");
  require("entete.html");
  require("sommaire.php");
  if (estVisiteurConnecte())//Si visiteur connecté
  {
		deconnecterVisiteur();
        
  }
?>
  <!-- Division principale -->
  <div id="contenu">
      <h2>Bienvenue sur l'intranet GSB</h2>
  </div>
<?php
  require("pied.html");
  require("fin.php");
?>