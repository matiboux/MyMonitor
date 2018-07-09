<?php
include('config.php');
include('db_connect.php');
/* function Ping($host, $timeout = 10)
{
    $output = array();
    $com = 'ping -n -w ' . $timeout . ' -c 1 ' . escapeshellarg($host);
    
    $exitcode = 0;
    exec($com, $output, $exitcode);
    
    if ($exitcode == 0 || $exitcode == 1)
    { 
        foreach($output as $cline)
        {
            if (strpos($cline, ' bytes from ') !== FALSE)
            {
                $out = (int)ceil(floatval(substr($cline, strpos($cline, 'time=') + 5)));
                return $out;
            }
        }
    }
    
    return FALSE;
}   */

function icmp_checksum($data) {
  if (strlen($data) % 2) {
    $data .= "\x00";
  }
  $bit = unpack('n*', $data);
  $sum = array_sum($bit);
  while  ($sum  >> 16) {
    $sum = ($sum >> 16) + ($sum & 0xffff);
  }
  return pack('n*', ~$sum);
}

function ping($host) {
  $tmp = "\x08\x00\x00\x00\x00\x00\x00\x00PingTest";
  $checksum = icmp_checksum($tmp);
  $package = "\x08\x00".$checksum."\x00\x00\x00\x00PingTest";
  $socket = socket_create(AF_INET, SOCK_RAW, 1);
  socket_connect($socket, $host, null);
  $timer = microtime(1);
  socket_send($socket, $package, strlen($package), 0);
  if (socket_read($socket, 255)) {
    return round((microtime(1) - $timer) * 1000, 2);
  }
}

function testsite($url){

  
//$url = 'http://www.google.fr'; 
$timeout = 10; 

// Initialisation d'une session cURL 
$ch = curl_init($url); 

// Forcer l'utilisation d'une nouvelle connexion (pas de cache) 
curl_setopt($ch, CURLOPT_FRESH_CONNECT, true); 

// Définition du timeout de la requête (en secondes) 
curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 

// Si l'URL est en HTTPS 
if (preg_match('`^https://`i', $url)) 
{ 
 // Ne pas vérifier la validité du certificat SSL 
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
} 

// Suivre les redirections [facultatif] 
// www.oseox.fr redirige par exemple automatiquement vers oseox.fr 
// Le code de retour serait ici 301 si l'on ne suivait pas les redirections 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 

// Récupération du contenu retourné par la requête 
// sous forme de chaîne de caractères via curl_exec() 
// (directement affiché au navigateur client sinon) 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

// Ne pas récupérer le contenu de la page requêtée 
curl_setopt($ch, CURLOPT_NOBODY, true); 

// Execution de la requête 
curl_exec($ch); 

// Récupération du code HTTP retourné par la requête 
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 

// Fermeture de la session cURL 
curl_close($ch); 

return $http_code; 


}
function random($var){
    $string = "";
    $chaine = "a0b1c2d3e4f5g6h7i8j9klmnpqrstuvwxy123456789";
    srand((double)microtime()*1000000);
    for($i=0; $i<$var; $i++){
        $string .= $chaine[rand()%strlen($chaine)];
    }
    return $string;
}

 ?>