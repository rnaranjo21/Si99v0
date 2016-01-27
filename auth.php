<?php

function core()
{
if (!isset($_SESSION['client']))
 $_SESSION['client']=new SoapClient("https://api.fm-web.us/webservices/CoreWebSvc/CoreWS.asmx?WSDL",array( "trace" => 1 ));
 return $_SESSION['client'];
}
function param($usuario,$password){
 
 session_start();
$_SESSION['A'] = param($_POST['Usuario'], $_POST['Password']);
$client =core();
 //Paramtros LOGIN

$params = array(
  "UserName" =>$usuario,
  "Password" =>$password,
  "ApplicationID" => "",
);
$response = $client->__soapCall('Login', array($params));
$token = $response->LoginResult->Token;

}
?>



