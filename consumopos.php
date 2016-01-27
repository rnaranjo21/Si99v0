<?php
session_start();
$self = $_SERVER['PHP_SELF'] ;//Obtenemos la página en la que nos encontramos
header("refresh:60;url=$self");

?>

<!DOCTYPE html>
<html>
<head>
  <link href="css/Estilo.css" rel="stylesheet" type="text/css"/>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="jquery-1.11.1.min.js" type="text/javascript"></script> 
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj63YpYW3PHaDhIWfShYTdyyPqT7CDeKE"
            type="text/javascript"></script>
 <script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
  <title>Si99</title>
                  <header>
             <h2>Tabla Ubicaciones Bahias Si99</h2>
                  <nav id="nav">
                     <a href="#" id="btnExport" style="width:50px;height:50px"> <img src="imagenes/reportes.png" ></a>
                     <a id="map1" href="#"  onclick="inicializaGoogleMaps()" style="width:50px;height:50px"> <img src="imagenes/maps.png" style="width:50px;height:50px" ></a>
                     <a href="cerrar.php" Id="current-page-item" style="width:50px;height:50px"><img src="imagenes/logout.png" ></a>
                       </nav>
                           </header>
                                </head>                         
 <br>
 <body>
  <div id="wrapper">
 </div>
<div id="layer">
  <div id="layerc">
    <p>Descargando Informaciòn...</p>
    <div id="layerClock"></div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  
  $("#dvData").html(function(){
    // Una vez se ha cargado el archivo, escondemos el reloj
    $("#layer").hide();
  });
});
</script>
  <script>
    $("#btnExport").click(function(e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
        e.preventDefault();
    });
    </script>

    
<style type="text/css">
body { 
  background-image: url(imagenes/Fondo.jpg);
  height: 100%; 
  margin: 0; 
  padding: 0; 
  text-align: center;
}
#layerClock {
  margin:auto;
  width:31px;height:31px;
  
background-image: url('imagenes/loading.gif');
}
table {
border-radius: 18px;
width:100%;
background:#f7fbff;
border-top:2px solid #a9cae8;
border-right:2px solid #a9cae8;
margin:1 auto;
border-collapse:collapse;

}
td {
border-radius: 18px;
color:#678197;
border-bottom:2px solid #a9cae8;
border-left:2px solid #a9cae8;
padding:.3em 1em;
text-align:center;
}

tr {
   border-radius: 18px;
  font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica,
  sans-serif;
  color: #6D929B;
  border-right: 2px solid #a9cae8;
  border-bottom: 2px solid #a9cae8;
  border-top: 2px solid #a9cae8;
  letter-spacing: 2px;
  text-transform: uppercase;
  text-align: left;
  padding: 6px 6px 6px 12px;
  }

th {
  width:;
  border-radius: 18px;
color:#678197;
border-bottom:2px solid #a9cae8;
border-left:2px solid #a9cae8;
padding:.3em 1em;
text-align:center;
}
#dvData {
    border-radius: 25px;
    border: 10px solid #73AD21;
    padding: 20px; 
    position: relative;
    left: 100px;
    width: 80%;
}

</style>
<?php
echo '<div  id="dvData" >';
//llamado WSDL
$client =new SoapClient("https://api.fm-web.us/webservices/CoreWebSvc/CoreWS.asmx?WSDL",array( "trace" => 1 )); 
$client2 = new SoapClient("https://api.fm-web.us/webservices/PositioningWebSvc/PositioningWS.asmx?WSDL",array( "trace" => 1 ));
$client3=new SoapClient("https://api.fm-web.us/webservices/AssetDataWebSvc/VehicleProcessesWS.asmx?WSDL",array( "trace" => 1 ));
$client4=new SoapClient("https://api.fm-web.us/webservices/MappingWebSvc/LocationProcessesWS.asmx?WSDL",array("trace"=>1));


$params = array(
  "UserName" =>$_SESSION['Usuario'],
  "Password" =>$_SESSION['Password'],
  "ApplicationID" => "",
);
$response = $client->__soapCall('Login', array($params));
$token = $response->LoginResult->Token;
//validacion login
//Error VAlidacion Token
if($token==null)
{
echo '<script languaje="javascript">';
echo   'alert("Contraseña Incorrecta");';
echo 'location.href = "cerrar.php";';
echo '</script>';
}
 //Paramtros LOGIN
//hander a mantener secion activa token
$core = "http://www.omnibridge.com/SDKWebServices/Core";
$posicion="http://www.omnibridge.com/SDKWebServices/Positioning";
$vehiculos="http://www.omnibridge.com/SDKWebServices/AssetData";
$location="http://www.omnibridge.com/SDKWebServices/Mapping";
$authHeader=array("Token" => $token);
//headers token para cada funcion a llamar 
$header[] = new SoapHeader($core,'TokenHeader',$authHeader, false);
$salida=$client->__setSoapHeaders($header);

$header1[] = new SoapHeader($posicion,'TokenHeader',$authHeader, false);
$salida=$client2->__setSoapHeaders($header1);

$header2[] = new SoapHeader($vehiculos,'TokenHeader',$authHeader, false);
$salida=$client3->__setSoapHeaders($header2);

$header3[]=new SoapHeader($location,'TokenHeader',$authHeader, false);
$salida=$client4->__setSoapHeaders($header3);
//parametros de consulta wsdl
$paramsStorg= array("NewOrganisationID" => 626);
$result= $client->__soapCall('SetCurrentOrgID', array($paramsStorg));
//parametros vehiculos
$paramvehi=array("TokenHeader");


//llamado al services vehiculos

$orgVehi =$client3->__soapCall('GetVehiclesList',array($paramvehi));

//mostrar result en tablas 

$vehi= $orgVehi->GetVehiclesListResult->Vehicle;
echo '<table>' ;
echo '<tr>';
echo '<th>';
echo "ID";
echo '</th>';
echo '<th>';
echo "BUS";
echo '</th>';
echo '<th>';
echo "Localizacion";
echo '</th>';
echo '<th>';
echo "Ultima posicion";
echo '</th>';
echo '</tr>';
//parametros posiscion
for($i=4;$i<count($vehi);$i++){
$vehiID=$orgVehi->GetVehiclesListResult->Vehicle[$i]->ID;
$vehiDes=$orgVehi->GetVehiclesListResult->Vehicle[$i]->Description;
$paramPosi= array("SpecificVehicleIDs"=>array("short"=>$vehiID));
$orgposi =$client2->__soapCall('GetLatestPositionPerVehicle',array($paramPosi));
//llamado al services posiciongps
$posi1=$orgposi->GetLatestPositionPerVehicleResult->GPSPosition->Latitude;
$posi2=$orgposi->GetLatestPositionPerVehicleResult->GPSPosition->Longitude;
//llamado localizacion 
$paramlocal= array("Longitude"=>$posi2,"Latitude"=>$posi1);
$orglocal =$client4->__soapCall('GetNearestLocation',array($paramlocal));
$positime=$orgposi->GetLatestPositionPerVehicleResult->GPSPosition->Time;
$date = new DateTime($positime);
//$location=$orglocal->GetNearestLocationResult->OriginLongitude;
//$location1=$orglocal->GetNearestLocationResult->OriginLatitude;
$location2=$orglocal->GetNearestLocationResult->LocationName;
echo '<tr>';
echo '<th>';
print($vehiID);
echo '</th>';
echo '<th>';
print($vehiDes);
echo '</th>';
echo '<th>';
print($location2);
echo '</th>';

echo '<th>';
print $date->format('d/m/Y (H:i:s)');
echo '</th>';
echo '</tr>';
}
echo '</table>';
 echo '</div>';
  ?> 
</body style ="zoom:200;" >
 </center>
 <br>
 <footer>
  <br>
<h2>&copy; Desarrollado Por Syscaf S.A.S</h2>
 </footer>