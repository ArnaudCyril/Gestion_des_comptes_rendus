    <!-- Division pour le sommaire -->
    <div id="menuGauche">
    <div id="infosUtil">
<?php
	
    if(estVisiteurConnecte())//Si la personne est connecté
	{
		$idd=$_SESSION["idUser"];
		$prenom=mysql_fetch_array(mysql_query("select * from visiteur where VIS_MATRICULE='$idd';"));
		$prenom2=$prenom["VIS_PRENOM"];
    
?>
	<h2>
<?php
    	echo $_SESSION["loginUser"].' '.$prenom2;
?>
	</h2>       
<?php
	}//Fin du if est connecté
?>  
      </div>
<?php
	if(estVisiteurConnecte())//Si la personne est connecté
	{
?>
<div name="gauche">
	<h2>Outils</h2>
	<ul><li>Comptes-Rendus</li>
		<ul>
			<li><a href="formRAPPORT_VISITE.php" >Nouveaux</a></li>
			<li><a href="formCONSULT_VISITE.php" >Consulter</a></li>
		</ul>
		<li>Consulter</li>
		<ul><li><a href="formMEDICAMENT.php" >Médicaments</a></li>
			<li><a href="formPRATICIEN.php" >Praticiens</a></li>
			<li><a href="formVISITEUR.php" >Autres visiteurs</a></li>
		</ul>
		
	</ul>
	<ul>
			<li><a href="pageDeco.php">Se déconncter</a></li>
		</ul>
</div>
<?php
        if ( nbErreurs($tabErreurs)>0)//Affichage des éventuelles erreurs déjà détectées
		{
            echo toStringErreurs($tabErreurs) ;
        }//Fin du if de verification
	}//Fin du if est connecté
?>
    </div>
    