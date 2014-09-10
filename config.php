<?php
//diretorio do sistema
define("KARFACIL.COM","http://karfacil.com/");
define("BASEPATH", dirname(__FILE__)."/");
define("BASEURL", "http://127.0.0.1/karfacil/");
//define("BASEURL", "http://karfacil.url.ph/");
define("ADMURL", BASEURL."painel.php");
define('CKEDITORPATH',"ckeditor/");
define("CLASSPATH", "classes/");
define("MODULOSPATH", "modulos/");
define("CSSPATH", "css/");
define("JSPATH", "js/");
define("IMGLOJASPATH", "img_lojas/");
define("IMGEXCLUSIVOSPATH", "img_lojas/exclusivos/");
define("IMGCARROSPATH", "img_carros/");
define("IMGPROPAGANDASPATH", "img_propagandas/");
define("IMGPARCEIROSPATH", "img_parceiros/");
define("IMGKARFACILPATH", "img_karfacil/");
define("UPLOADLOJASPATH",IMGLOJASPATH.'/');
define("UPLOADPROPAGANDASPATH",dirname(__FILE__).BASEURL."img_propagandas/");
//banco de dados 

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "karfacil");

/*
define("DBHOST", "mysql.hostinger.com.br");
define("DBUSER", "u473504575_kar");
define("DBPASS", "Maickonr201427");
define("DBNAME", "u473504575_kar");
*/

/*
echo BASEPATH."<br />";
echo BASEURL."<br />";
echo ADMURL."<br />";
echo CLASSPATH."<br />";
echo MODULOSPATH."<br />";
echo CSSPATH."<br />";
echo JSPATH."<br />";

echo DBHOST."<br />";
echo DBUSER."<br />";
echo DBPASS."<br />";
echo DBNAME."<br />";
*/

?>