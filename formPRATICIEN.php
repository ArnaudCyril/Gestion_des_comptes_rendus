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
	$req="select * from praticien order by PRA_NOM";
  $rep=mysql_query($req);
  
  
?>
<html>
<head>
	<title>formulaire PRATICIEN</title>
	
	<script language = "javascript">
		function chercher($pNumero) {  
			var xhr_object = null; 	    
			if(window.XMLHttpRequest) // Firefox 
				xhr_object = new XMLHttpRequest(); 
			else if(window.ActiveXObject) // Internet Explorer 
					xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); 
				else { // XMLHttpRequest non supporté par le navigateur 
					alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
					return; 
				}   
			//traitement à la réception des données
		   xhr_object.onreadystatechange = function() { 
			if(xhr_object.readyState == 4 && xhr_object.status == 200) { 
				 var formulaire = document.getElementById("formPraticien");
				formulaire.innerHTML=xhr_object.responseText;			} 
		   }
		   //communication vers le serveur
		   xhr_object.open("POST", "cherchePraticien.php", true); 
		   xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
		   var data = "pratNum=" + $pNumero ;
		   xhr_object.send(data); 
		   
	   }
	</script>
</head>
<body>	
	  <!-- Division principale -->
  <div id="contenu">
      <h2>Bienvenue sur l'intranet GSB</h2>
  
	
		<h1> Praticiens </h1>
		<form name="formListeRecherche" action=# method="POST">
			<select name="lstPrat" class="titre">
				<?php
				while($maLigne=mysql_fetch_array($rep))
				{
					
				?>
				<option 
				<?php
				if(isset($_POST['lstPrat']))
				{
					
					if($maLigne['PRA_CODE']==$_POST['lstPrat'])
					{
						?>
						selected="true"
						<?php
					}
				}
				?>
				
				value="<?php echo $maLigne["PRA_CODE"] ?>" name="choix"><?php echo $maLigne["PRA_NOM"]." ".$maLigne["PRA_PRENOM"] ?></option>
				<?php
				}
				?>
				
			</select>	
			<input class="zone" name="rechercher" type="submit" />
		</form>
		<?php
		if(isset($_POST["rechercher"]))
		{
		?>
		<table border=1>
		<thead>
			<th width= 70>Code</th>
			<th width= 150>Nom</th>
			<th width= 150>Prenom</th>
			<th width= 150>Adresse</th>
			<th width= 150>Code postal</th>
			<th width= 150>Ville</th>
			<th width= 150>Coeff notoriet&eacute</th>
			<th width= 150>Type de Medecin</th>
		</thead>
		<tbody>
		<?php
		$pra=$_POST['lstPrat'];
		$requette="select * from praticien where PRA_CODE='$pra';";
			
				$resultat=mysql_query($requette);
				while($ligne=mysql_fetch_array($resultat))
				{
					$num=$ligne['PRA_CODE'];
					$nom=$ligne['PRA_NOM'];
					$prenom=$ligne['PRA_PRENOM'];
					$Adresse=$ligne['PRA_ADRESSE'];
					$cp=$ligne['PRA_CP'];
					$ville=$ligne['PRA_VILLE'];
					$coeff=$ligne['PRA_COEFNOTORIETE'];
					$type=$ligne['TYP_CODE'];
					
					$requette2="select * from type_praticien where TYP_CODE='$type';";
					$resultat2=mysql_query($requette2);
					$maLigne=mysql_fetch_array($resultat2);
					$type=$maLigne['TYP_LIBELLE'];
				}
			
				?>
				<tr>
					<th width=70><?php echo $num ?></th>
					<th width=150><?php echo $nom?></th>
					<th width=150><?php echo $prenom?></th>
					<th width=150><?php echo $Adresse?></th>
					<th width=150><?php echo $cp?></th>
					<th width=150><?php echo $ville?></th>
					<th width=150><?php echo $coeff?></th>
					<th width=150><?php echo $type?></th>
				</tr>
		</tbody>
		</table>
		<?php
		}
		?>
	
</div>
</body>
</html>

<?php
  require("pied.html");
  require("fin.php");
?>
