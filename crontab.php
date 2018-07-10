<?php
include 'db_connect.php';
require ('includes/functions.inc.php');

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

      $sql2 = 'SELECT * FROM admin WHERE id= ?' ;
      $req2 = $bdd->prepare($sql2);
      $req2->execute(array($donnees['user']));
      while($row = $req2->fetch()) {

        include 'includes/mailoff.php';
      }  

    
    }
  }
  else
  {
    $sql = 'UPDATE servers SET mail_send = ? WHERE IP = ?';
    $req = $bdd->prepare($sql);
    $req->execute(array(false, $donnees['IP']));
    echo '<span class="label label-success">En ligne</span>'; fclose($socket);

  
    if($donnees['mail_send']){

      $sql2 = 'SELECT * FROM admin WHERE id= ?' ;
      $req2 = $bdd->prepare($sql2);
      $req2->execute(array($donnees['user']));
      while($row = $req2->fetch()) {

        include 'includes/mailon.php';
      }  



    
    };
    $result = ping($donnees['IP']);
    echo " - " . $result . " ms <br />";
    $sql3 = 'UPDATE servers SET reponse_time = ? WHERE IP = ?';    
    $req3 = $bdd->prepare($sql3);
    $req3->execute(array($result,$donnees['IP']));
  
  }

}


$sql = 'SELECT * FROM sites' ;
$req = $bdd->prepare($sql);
$req->execute();
while($row = $req->fetch()) {

  $codehttp = testsite($row['site']);
echo $codehttp . "<br />";
//echo $row['id'] . "<br />";
  if ($codehttp == '200'){

    $sql2 = 'UPDATE sites SET code_http = ? WHERE id = ?';    
    $req2 = $bdd->prepare($sql2);
    $req2->execute(array($codehttp,$row['id']));

    if ($row['mail_send'] == true){

      $sql2 = 'SELECT * FROM admin WHERE id= ?' ;
      $req2 = $bdd->prepare($sql2);
      $req2->execute(array($row['user']));
      while($donnees = $req2->fetch()) {

        include 'includes/mailon_site.php';
      }    
      $sql2 = 'UPDATE sites SET mail_send = ? WHERE id = ?';    
      $req2 = $bdd->prepare($sql2);
      $req2->execute(array(false,$row['id'])); 
      

    

    }


  }else{
    
    $sql2 = 'UPDATE sites SET code_http = ? WHERE id = ?';    
    $req2 = $bdd->prepare($sql2);
    $req2->execute(array($codehttp,$row['id']));

    if ($row['mail_send'] == false){

      $sql2 = 'SELECT * FROM admin WHERE id= ?' ;
      $req2 = $bdd->prepare($sql2);
      $req2->execute(array($row['user']));
      while($donnees = $req2->fetch()) {
        include 'includes/mailoff_site.php';
      
      }  
      $sql2 = 'UPDATE sites SET mail_send = ? WHERE id = ?';    
      $req2 = $bdd->prepare($sql2);
      $req2->execute(array(true,$row['id'])); 


     

    }
  }




}    




$reponse->closeCursor(); // Termine le traitement de la requête




?>
