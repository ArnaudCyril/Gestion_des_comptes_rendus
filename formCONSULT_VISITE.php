<?php
  require("lib/init.php");
  require("entete.html");
  require("sommaire.php");
  unset($_SESSION['sector']);
  unset($_SESSION['vis']);
  if (!estVisiteurConnecte())//Si visiteur non connecté
  {
        header("Location: connexion.php");  
  }
  if((isset($_POST['VIS_NUM']))and(isset( $_POST['action1'])))
	{
	$_SESSION['VisAVoir']=$_POST['VIS_NUM'];
	}
?>
  <html><head>
	<title>formulaire RAPPORT_VISITE</title>
	</head>
	<body>
  <div id="contenu">
      <h2>Bienvenue sur l'intranet GSB</h2>
		<form name="formCONSULT_VISITE1" method="post" action="#">
	Selectionnez une visiteur : <select  name="VIS_NUM" >
			<?php
			$req="select * from visiteur order by VIS_NOM;";
			$res=mysql_query($req);
			while($ligne=mysql_fetch_array($res))
			{
				$nom=$ligne['VIS_NOM'];
				$prenom=$ligne['VIS_PRENOM'];
				$code=$ligne['VIS_MATRICULE'];
				?>
				<option 
				<?php
				
				if(isset($_SESSION['VisAVoir']))
				{
					
					if($code==$_SESSION['VisAVoir'] or $code==$_POST['VIS_NUM'])
					{
						?>
						selected="true"
						<?php
					}
				}
				?>
				value="<?php echo $code ?>"><?php echo $nom." ".$prenom ?></option>
				<?php
			}
			?>
			</select>
			<input type=submit name="action1">
		<?php
		if(isset($_POST['action1'])or(isset($_SESSION['VisAVoir'])))
	{
		
		?>
		<form name="formCONSULT_VISITE2" method="post" action="#">
		Selectionnez une date de visite :
		<select  name="DATE_NUM" >
			<?php
			$vis=$_SESSION['VisAVoir'];
			$req="select RAP_DATE from rapport_visite where VIS_MATRICULE='$vis';";
			$res=mysql_query($req);
			while($ligne=mysql_fetch_array($res))
			{
				$date=$ligne['RAP_DATE'];
			
				?>
				<option 
				<?php
				if(isset($_POST['DATE_NUM']))
				{
					
					if($date==$_POST['DATE_NUM'])
					{
						?>
						selected="true"
						<?php
					}
				}
				?>
				
				><?php echo $date?></option>
				
				<?php
			}
			?>
			</select>
			<input type=submit name="action2">
		<?php
	}
		if(isset($_POST['action2']))
		{
		
			?>
			<p>Rapport de la visite de <?php 
			$code=$_SESSION['VisAVoir'];
			$r="select * from visiteur where VIS_MATRICULE='$code';";
			$r2=mysql_query($r);
			$temp=mysql_fetch_array($r2);
			$name=$temp['VIS_NOM']." ".$temp['VIS_PRENOM'].' ';
			echo $name;

			?>r&eacutealis&eacutee le  <?php echo $_POST['DATE_NUM']?></p>
			<table border=1>
				<thead>
					<th width=100>Numero</th>
					<th width=100>Praticien</th>
					<th width=100>Remplacant</th>
					<th width=100>Coeff</th>
					<th width=100>Motif</th>
					<th width=100>Bilan</th>
					
				</thead>
				<tbody>
				<?php
				$vis=$_SESSION['VisAVoir'];
				$date=$_POST['DATE_NUM'];
				$requette="select * from rapport_visite where VIS_MATRICULE='$vis' and RAP_DATE='$date';";
				
				$resultat=mysql_query($requette);
				while($ligne=mysql_fetch_array($resultat))
				{
					$num=$ligne['RAP_CODE'];
					$pra=$ligne['PRA_CODE'];
					$remplace=$ligne['remplace'];
					$coeff=$ligne['COEFF_CONFIANCE'];
					$motif=$ligne['RAP_MOTIF'];
					$bilan=$ligne['RAP_BILAN'];
					$nomr=$ligne['REMPL_NOM'];
					$prenomr=$ligne['REMPL_PRENOM'];
				}
				$requetteA="select * from praticien where PRA_CODE='$pra';";
				$resultatA=mysql_query($requetteA);
				while($ligne=mysql_fetch_array($resultatA))
				{
					$pr=$ligne['PRA_NOM'];
					$aticien=$ligne['PRA_PRENOM'];
						
				}
				if($remplace=="Oui")
					{
						$pr=$nomr;
						$aticien=$prenomr;
					}
				?>
				<tr>
					<th width=100><?php echo $num ?></th>
					<th width=100><?php echo $pr." ".$aticien?></th>
					<th width=100><?php echo $remplace ?></th>
					<th width=100><?php echo $coeff?></th>
					<th width=100><?php echo $motif?></th>
					<th width=200><?php echo $bilan?></th>
				</tr>
				</tbody>
			</table>
			</br>
			</br>
			<p>Produits pr&eacutesent&eacutes lors de la visite : </p>
			<table border=1>
				<thead>
					<th width=100>Nom</th>
					<th width=100>Composition</th>
					<th width=200>Effets</th>
					<th width=200>Contre indications</th>

					
				</thead>
				<tbody>
				<?php
				$vis2=$_SESSION['VisAVoir'];
				$date2=$_POST['DATE_NUM'];
				$requette2="select * from presentation where RAP_CODE='$num';";
				
				$resultat2=mysql_query($requette2);
				while($ligne2=mysql_fetch_array($resultat2))
				{
					$codeMed=$ligne2['MED_DEPOTLEGAL'];
					$requette3="select * from medicament where MED_DEPOTLEGAL='$codeMed';";
				
					$resultat3=mysql_query($requette3);
					while($ligne3=mysql_fetch_array($resultat3))
					{
							$mnom=$ligne3['MED_NOMCOMMERCIAL'];
							$mcompo=$ligne3['MED_COMPOSITION'];
							$meffets=$ligne3['MED_EFFETS'];
							$mcontrind=$ligne3['MED_CONTREINDIC'];
					}
				?>
				<tr>
					<th width=100><?php echo $mnom ?></th>
					<th width=100><?php echo $mcompo?></th>
					<th width=100><?php echo $meffets?></th>
					<th width=100><?php echo $mcontrind?></th>
				
				</tr>
				<?php
				}
				?>
				</tbody>
			</table>
			</br>
			</br>
			<p>Echantillons offerts : </p>
			<table border=1>
				<thead>
					<th width=100>Nom</th>
					<th width=100>Quantite</th>
					<th width=100>Composition</th>
					<th width=200>Effets</th>
					<th width=200>Contre indications</th>

					
				</thead>
				<tbody>
				<?php
				$vis4=$_SESSION['VisAVoir'];
				
				$date4=$_POST['DATE_NUM'];
				$requette4="select * from offrir where RAP_CODE='$num';";
				
				$resultat4=mysql_query($requette4);
				while($ligne4=mysql_fetch_array($resultat4))
				{
					$codeMed=$ligne4['MED_DEPOTLEGAL'];
					$qte=$ligne4['OFF_QTE'];
					$requette5="select * from medicament where MED_DEPOTLEGAL='$codeMed';";
					
					$resultat5=mysql_query($requette5);
					while($ligne5=mysql_fetch_array($resultat5))
					{
							$mnom=$ligne5['MED_NOMCOMMERCIAL'];
							$mcompo=$ligne5['MED_COMPOSITION'];
							$meffets=$ligne5['MED_EFFETS'];
							$mcontrind=$ligne5['MED_CONTREINDIC'];
					}
				?>
				<tr>
					<th width=100><?php echo $mnom ?></th>
					<th width=100><?php echo $qte ?></th>
					<th width=100><?php echo $mcompo?></th>
					<th width=100><?php echo $meffets?></th>
					<th width=100><?php echo $mcontrind?></th>
				
				</tr>
				<?php
				}
				?>
				</tbody>
			</table>
			
			<?php
		}
		?>
		</form>
	</div>
  </body>
  </html>
<?php
  require("pied.html");
  require("fin.php");
?>
