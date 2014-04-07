<?php
require("lib/init.php");
$deselect=0;
if(isset($_POST['lstDept'])and isset($_POST['action']))
{
if($_POST['lstDept']!="all")
$_SESSION['sector']=$_POST['lstDept'];   
else
unset($_SESSION['sector']);   

$deselect=1;    

}
if(isset($_POST['listVis']))
{

$_SESSION['vis']=$_POST['listVis'];
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
		<h1> Visiteurs </h1>
		</br>
		Selectionnez directement un visiteur 
			<?php
			
			if(isset($_SESSION['sector']))
			{
				$secteur1=$_SESSION['sector'];
				$zone=mysql_fetch_array(mysql_query("select * from secteur where SEC_CODE='$secteur1';"));
				echo "de la zone ".$zone["SEC_LIBELLE"]." : ";
			}
			?>
		
		<select name="listVis" class="titre">
		<?php
			$req="select * from visiteur order by VIS_NOM;";
			if(isset($_SESSION["sector"]))
			{
			
					$sect=$_SESSION["sector"];
					$req="select * from visiteur WHERE SEC_CODE='$sect' order by VIS_NOM;";
			}
			$res=mysql_query($req);
			while($ligne=mysql_fetch_array($res))
			{
				$nom2=$ligne['VIS_NOM'];
				$prenom2=$ligne['VIS_PRENOM'];
				$code=$ligne['VIS_MATRICULE'];
				?>
				<option value="<?php echo $code ?>"
					<?php
					if(isset($_SESSION['vis']) and $deselect==0)
					{
						if($code==$_SESSION['vis'])
						{
		
						?> 
					selected="true"
					<?php
						}
					}
				
				?>
					><?php echo $nom2." ".$prenom2 ?></option>
				<?php
			}
			?>
			
		</select>
		
		<input type="submit" name="actionvis"/>
		</form>
		</br>
		<?php 
		
		if(isset($_POST["action"] ) or (isset($_POST['actionvis'])))
		{
		$code="";
		if(isset($_SESSION['sector']))
		{
		$code="%".$_SESSION['sector']."%";
		}
		$codeV=$_SESSION['vis'];
		if(isset($_POST["action"] ))
		{
						if(isset($_SESSION['sector']))
						{
						$requette2="select * from visiteur where SEC_CODE like '$code' order by VIS_NOM desc;";
						}
						else $requette2="select * from visiteur order by VIS_NOM desc;";
		}
		
		if(isset($_POST["actionvis"]))
		{
						$requette2="select * from visiteur where VIS_MATRICULE='$codeV';";
						
		}
		
		
		$resultat2=mysql_query($requette2);
		
		
		while($maLigne=mysql_fetch_array($resultat2))
		{
			
			
		
			$nom=$maLigne['VIS_NOM'];
			
			$prenom=$maLigne['VIS_PRENOM'];
			$adresse=$maLigne['VIS_ADRESSE'];
			$cp=$maLigne['VIS_CP'];
			$ville=$maLigne['VIS_VILLE'];
			$sec=$maLigne['SEC_CODE'];
			
			$requette3="select * from secteur where SEC_CODE='$sec';";
					$resultat3=mysql_query($requette3);
					$maLigne2=mysql_fetch_array($resultat3);
					$sec=$maLigne2['SEC_LIBELLE'];
			
			
		}

		/////////////////
		?>
		
		
		
		
		<form name="formVI" method="post" action="formVIS.php">
		
		<center>
		</center></br>
		<table border=1>
		<thead>
			<th width="150">NOM</th>
			<th width="150">PRENOM</th>
			<th width="150">ADRESSE</th>
			<th width="150">CP</th>
			<th width="150">VILLE</th>
			<th width="150">SECTEUR</th>
			
			
		</thead>
		<tbody>
			<th width="150"><?php echo $nom ?></th>
			<th width="150"><?php echo $prenom ?></th>
			<th width="150"><?php echo $adresse ?></th>
			<th width="150"><?php echo $cp?></th>
			<th width="150"><?php echo $ville ?></th>
			<th width="150"><?php echo $sec ?></th>
			
		</tbody>
		</table>
		
		</form>
		
		<?php } ?>
</div>
</body>
</html>
