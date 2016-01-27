<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta content="IE=edge,requiresActiveX=true" http-equiv="X-UA-Compatible" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<script src="jquery-1.11.1.min.js" type="text/javascript"></script> 
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>	
<title>LOGIN</title>
<body style="background-image: url(imagenes/Fondo.jpg);">
<center>
<form name="login" method="post" action="validar.php">
<table width='350' border='0' class='ventanas' cellspacing='0' cellpadding='0'>
<tr>
	<td colspan='3' class='tabla_ventanas' height='10' colspan='3' align='center'>::::::::  INICIO  :::::::: </td>
</tr>
<img src="imagenes/si99.png" width="140" height="140">
<tr><td colspan=3><br/></td></tr>
<tr>
<td colspan='3'>
	<center>
	<table>
	<tr>
		<td><strong>Usuario:</strong></td>
		<td><input type="text" name="Usuario" class="CajaTexto" size="30"  placeholder="Ingresa tu ususario"required=required x-webkit-speech="true "/></td>
	</tr>
	<tr>
		<td><strong>Contraseña:</strong></td>
		<td><input type="password" name="Password" class="CajaTexto" size="30" placeholder="Ingresa tu Contraseña"required=required x-webkit-speech="true"/></td>
	</tr>
	</table>
	</center>
</td>
</tr>
<tr>
<td colspan=3 align='center'><img src='imagenes/HRline200.png' width='250'></td>
</tr>
<tr>
<td height='50' colspan=3 align='center'><input type="Submit" class="clean-gray" value = Ingresar></td>
</tr>
</table>
</form>
</center>
</body>

</html>