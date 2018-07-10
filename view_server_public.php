<?php 

require('db_connect.php');
require('includes/functions.inc.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/shards.min.css">
  </head>
  <body>
  <meta http-equiv="refresh" content="60">  

    <!-- Optional JavaScript -->
    <!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../public/js/shards.min.js"></script>
  </body>
</html>


  

<div class="container">
    
<div class="section-messages">
    

</div> 


<div class="section-status">
   <br /> <br /> 

 <?php

$sql = 'SELECT id FROM admin WHERE token_site= ?' ;
$req = $bdd->prepare($sql);
$req->execute(array($_GET['token']));
while($row = $req->fetch()) {
$id_user = $row['id'];
}    

$sql = 'SELECT count(*) FROM servers WHERE user= ? and mail_send != ?';
$req = $bdd->prepare($sql);
$req->execute(array($id_user,'0')); 
while($row = $req->fetchColumn()){
//echo $row;
$nbsiteerror = $row;
}
if ($nbsiteerror >= 1){

    echo '<div class="alert alert-warning"> Vos services rencontrent des problèmes</div>';
}else{

    echo '<div class="alert alert-success"> Tous les systèmes sont opérationnels</div>';
}
?>

</div> 



<?php

$sql3 = 'SELECT * FROM category WHERE id_user= ? AND type = ?' ;
$req3 = $bdd->prepare($sql3);
$req3->execute(array($id_user,'server'));
while($row3 = $req3->fetch()) {
 

?>
<div class="section-components">
    
<ul class="list-group components">
    
<li class="list-group-item group-name active">
    <i class="ion-ios-minus-outline group-toggle"></i> 
    <strong><?php echo $row3['name_category']; ?></strong> 
<?php
$sql = 'SELECT * FROM servers WHERE user= ? AND category = ?' ;
$req = $bdd->prepare($sql);
$req->execute(array($id_user,$row3['id']));
while($row = $req->fetch()) {
?>

    
    <div class="group-items "><li class="list-group-item sub-component"><?php echo $row['nom']; ?><i data-toggle="tooltip" data-title="" data-container="body" class="ion ion-ios-help-outline help-icon" data-original-title="" title=""></i> <div class="pull-right"><small data-toggle="tooltip" title="" class="text-component-1 greens" data-original-title=""><?php if($row['mail_send'] == '0'){ echo '<img src="../images/round-success.jpg" height="11px"> Operationnel'; } else { echo '<img src="../images/round-error.jpg" height="11px"> Indisponible : Erreur '; } ?></small></div></li>


<?php } ?>
</div>
</nav>
</li>
</div>
<br />
<?php } ?>