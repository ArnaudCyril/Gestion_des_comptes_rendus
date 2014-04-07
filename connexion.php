<?php
  require("lib/init.php");
  require("entete.html");
  require("sommaire.php");


  //$etape=(count($_POST)!=0)?'validerConnexion' : 'demanderConnexion';
  $error=0;
  if(isset($_POST["action"]))
  {
		$login = lireDonneePost("txtLogin");
		$mdp = lireDonneePost("txtMdp");
		// $jour=substr($mdp,0,2);
		// $mois=substr($mdp,3,3);
		// $annee=substr($mdp,7,4);
		// if($mois=="jan"){ $mois="01";}
		// if($mois=="feb"){ $mois="02";}
		// if($mois=="mar"){ $mois="03";}
		// if($mois=="apr"){ $mois="04";}
		// if($mois=="may"){ $mois="05";}
		// if($mois=="jun"){ $mois="06";}
		// if($mois=="jul"){ $mois="07";}
		// if($mois=="aug"){ $mois="08";}
		// if($mois=="sep"){ $mois="09";}
		// if($mois=="oct"){ $mois="10";}
		// if($mois=="nov"){ $mois="11";}
		// if($mois=="dec"){ $mois="12";}
		// $mdp=$annee.'-'.$mois.'-'.$jour;
		
		$requete = "SELECT * FROM visiteur WHERE VIS_NOM='$login' AND VIS_DATEEMBAUCHE='$mdp'";
		$resultat=mysql_query($requete);
		while($maLigne=mysql_fetch_array($resultat))
		{
			$id=$maLigne['VIS_MATRICULE'];
		}
		if(mysql_num_rows($resultat)>0)
		{
					
						$_SESSION["Matricul"]=$id;
						affecterInfosConnecte($id, $login);
				        header("Location:index.php");

		}
		else
		{
			$error=1;
		}
		
	
  }
  /*if ($etape=='validerConnexion')// un client demande à s'authentifier
  { 
		echo 'lol';
      // acquisition des données envoyées, ici login et mot de passe
      $login = lireDonneePost("txtLogin");
      $mdp = lireDonneePost("txtMdp");   
      $lgUser = verifierInfosConnexion($idConnexion, $login, $mdp) ;
      // si l'id utilisateur a été trouvé, donc informations fournies sous forme de tableau
      if(is_array($lgUser)) 
	  { 
			
          affecterInfosConnecte($lgUser["id"], $lgUser["login"]);
      }
      else 
	  {
			
          ajouterErreur($tabErreurs, "Pseudo et/ou mot de passe incorrects");
      }
  }
  if($etape == "validerConnexion" && nbErreurs($tabErreurs)==0)
  {
        header("Location:index.php");
  }*/
?>
<!-- Division pour le contenu principal -->
    <div id="contenu">
      <h2>Identification utilisateur</h2>
<?php
        /*  if($etape=="validerConnexion")//Si la connexion est validé
          {
              if(nbErreurs($tabErreurs)>0) 
              {
                echo toStringErreurs($tabErreurs);
              }
          }*/
		  if($error==1)
		  {
			echo "Login ou mot de passe incorect !";
			}
?>               
      <form id="frmConnexion" action="#" method="post">
      <div class="corpsForm">
        <input type="hidden" name="etape" id="etape" value="validerConnexion" />
      <p>
        <label for="txtLogin" accesskey="n">* Login : </label>
        <input type="text" id="txtLogin" name="txtLogin" maxlength="20" size="15" value="" title="Entrez votre login" />
      </p>
      <p>
        <label for="txtMdp" accesskey="m">* Date d'embauche : </label>
        <input type="text" id="txtMdp" name="txtMdp">
      </p>
      </div>
      <div class="piedForm">
      <p>
        <input type=submit id="ok" name="action" value="Valider" />
        <input type="reset" id="annuler" value="Effacer" />
      </p> 
      </div>
      </form>
    </div>
<?php
  require("pied.html");
  require("fin.php");
?>