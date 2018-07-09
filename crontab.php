<?php
include 'db_connect.php';
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
 ?>
<?php
$reponse = $bdd->prepare('SELECT * FROM `servers`');
$reponse->execute(array($user));
while ($donnees = $reponse->fetch())
{
?>
                    <tr>
                      <td style="width:20%;"><?php echo $donnees['nom']; ?></td>
                      <td  style="width:50%;">
<?php
$ip = $donnees['IP'];
$port = $donnees['port'];
$status = @fsockopen($ip, $port, $errno, $errstr, 30); // true si up, false si down.

  if (!$status) {
    $sql = 'UPDATE servers SET mail_send = ? WHERE IP = ?';
    $req = $bdd->prepare($sql);
    $req->execute(array(true, $donnees['IP']));
    echo '<span class="label label-danger">Hors ligne</span>'; fclose($socket);

    if(!$donnees['mail_send']){
      include 'includes/mailoff.php';
    }
  }
  else
  {
    $sql = 'UPDATE servers SET mail_send = ? WHERE IP = ?';
    $req = $bdd->prepare($sql);
    $req->execute(array(false, $donnees['IP']));
    echo '<span class="label label-success">En ligne</span>'; fclose($socket);

    if($donnees['mail_send']){
      include 'includes/mailon.php';
    };
    $result = ping($donnees['IP']);
    echo " - " . $result . " ms";
    $sql3 = 'UPDATE servers SET reponse_time = ? WHERE IP = ?';    
    $req3 = $bdd->prepare($sql3);
    $req3->execute(array($result,$donnees['IP']));
  
  }

}

$reponse->closeCursor(); // Termine le traitement de la requête


?>
