<?php
require("lib/init.php");

if(isset($_POST['listFam']))
{
$_SESSION['famille']=$_POST['listFam'];

}
if(isset($_POST['listMed']))
{

$_SESSION['med']=$_POST['listMed'];
}
?>
<html>
<head>
<link type="text/css" rel="stylesheet" href="styles/styles2.css"/>
</head>
<body>
 <div id="contenu">
      <h2 id="iframe">Bienvenue sur l'intranet GSB</h2>
	<form name="formVISITEUR" method="post" action="#">
		<h1> Medicaments </h1>Selectionnez une famille de m&eacutedicament : 
		<select name="listFam" class="titre">
		<?php 
		$requette="select * from familles;";
		$resultat=mysql_query($requette);
		while($ligne=mysql_fetch_array($resultat))
		{
			$idSect=$ligne['FAM_CODE'];
			$libSect=$ligne['FAM_LIBELLE'];
			?><option
			value="<?php echo $idSect ?>"  
			<?php
			if(isset($_SESSION['famille']))
			{
				if($idSect==$_SESSION['famille'])
				{
		
				?> 
					selected="true"
				<?php
				}
			}
			?>
			><?php echo $libSect ?></option>
		<?php
		}?>
		</select>
		<input type=submit name="action" />
		</br>
		et/ou
		</br>
		Selectionnez directement un M&eacutedicament 
			<?php
			if(isset($_SESSION['famille']))
			{
				
				//$zone=mysql_fetch_array(mysql_query("select * from secteur where SEC_CODE='$_SESSION['famille']';"))["SEC_LIBELLE"];
				echo "de la famille ".$_SESSION['famille']." : ";
			}
			?>
		
		<select name="listMed" class="titre">
		<?php
			$req="select * from medicament order by MED_NOMCOMMERCIAL;";
			if(isset($_SESSION["famille"]))
			{
			
					$sect=$_SESSION["famille"];
					$req="select * from medicament WHERE FAM_CODE='$sect' order by MED_NOMCOMMERCIAL;";
			}
			$res=mysql_query($req);
			while($ligne=mysql_fetch_array($res))
			{
			
				$nom=$ligne['MED_NOMCOMMERCIAL'];
				$code=$ligne['MED_DEPOTLEGAL'];
				?>
				<option value="<?php echo $code ?>"
					<?php
					if(isset($_SESSION['med']))
					{
						if($code==$_SESSION['med'])
						{
		
						?> 
					selected="true"
					<?php
						}
					}
				?>
					><?php echo $nom?></option>
				<?php
			}
			?>
			
		</select>
		
		<input type="submit" name="actionvis"/>
		</form>
		</br>
		<?php 
		if(isset($_POST["action"] )  or (isset($_POST['actionvis'])))
		{
		$code="";
		if(isset($_SESSION['famille']))
		{
		$code=$_SESSION['famille'];
		}
		$codeV=$_SESSION['med'];
		if(isset($_POST["action"] ))
		{
						$requette2="select * from medicament where FAM_CODE='$code' order by MED_NOMCOMMERCIAL desc;";
		}
		if(isset($_POST["actionvis"] )or(isset($_POST["action"] )))
		{
						$requette2="select * from medicament where FAM_CODE='$code' order by MED_NOMCOMMERCIAL desc;";
						
		}
		
		$resultat2=mysql_query($requette2);	
		while($maLigne=mysql_fetch_array($resultat2))
		{
			
			
		
			$code=$maLigne['MED_DEPOTLEGAL'];
			//////////////
			$nom=$maLigne['MED_NOMCOMMERCIAL'];
			$famille=$maLigne['FAM_CODE'];
			$compo=$maLigne['MED_COMPOSITION'];
			$effets=$maLigne['MED_EFFETS'];
			$contrindic=$maLigne['MED_CONTREINDIC'];
			
			$requette3="select * from famille where FAM_CODE='$famille';";
					$resultat3=mysql_query($requette3);
					$maLigne2=mysql_fetch_array($resultat3);
					$famille=$maLigne2['FAM_LIBELLE'];
			
		}

		/////////////////
		?>
		
		
		
		
		<form name="formVI" method="post" action="formMedoc.php">
		
		 
		<table border=1>
		<thead>
			<th width="150">DEPOT LEGAL</th>
			<th width="150">NOM COMMERCIAL</th>
			<th width="150">FAMILLE</th>
			<th width="150">COMPOSITION</th>
			<th width="150">EFFETS</th>
			<th width="150">CONTRE INDICATIONS</th>
			
			
			
		</thead>
		<tbody>
			<th width="150"><?php echo $code ?></th>
			<th width="150"><?php echo $nom ?></th>
			<th width="150"><?php echo $famille ?></th>
			<th width="150"><?php echo $compo?></th>
			<th width="150"><?php echo $effets ?></th>
			<th width="150"><?php echo $contrindic ?></th>
			
		</tbody>
		</table>
		
		</form>
		
		<?php } ?>
</div>
</body>
</html>
