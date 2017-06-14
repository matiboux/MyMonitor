<?php
include 'db_connect.php';
 ?>
<?php
try
{
$bdd = new PDO('mysql:host='.$bdd_host.';dbname='.$bdd_db.';charset=utf8', $bdd_user, $bdd_password);
}
catch(Exception $e)
{

    // En cas d'erreur, on affiche un message et on arrête tout

        die('Erreur : '.$e->getMessage());
  }

// On récupère tout le contenu de la table jeux_video
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
if (!$socket = @fsockopen($ip, $port, $errno, $errstr, 30))

{
 echo '';


$destinataire = $donnees['user'];
// Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
$expediteur = $donnees['user']
$objet = 'MyMonitor - Serveur Offline'; // Objet du message
$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
$headers .= 'From: "MyMonitor"<'.$expediteur.'>'."\n"; // Expediteur
$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire
$headers .= 'Cc: '.$copie."\n"; // Copie Cc
$headers .= 'Bcc: '.$copie_cachee."\n\n"; // Copie cachée Bcc
$message = 'Bonjour,

Votre serveur '.$ip.' ne semble plus joignable.
Merci de regarder au plus vite.
MyMonitor';
if (mail($destinataire, $objet, $message, $headers)) // Envoi du message

























{
    echo '';
}
else // Non envoyé
{
    echo "";
}


}
else
{ echo '<span class="label label-success">En ligne</span>'; fclose($socket);
}
?>






<?php

}


$reponse->closeCursor(); // Termine le traitement de la requête


?>
