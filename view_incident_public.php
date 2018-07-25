<?php 

require('db_connect.php');
require('includes/functions.inc.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title> Statut des services </title>
    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/shards.min.css">
  </head>
  <body>
  <meta http-equiv="refresh" content="60">  

    <!-- Optional JavaScript -->
    <!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../../public/js/shards.min.js"></script>
  
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
  <style>

.panel-warning{
  border-color:orange;    
  }
    
  .panel-warning .panel-heading{
  border-color:orange;
  background:orange;
  color:#fff;  
  }
    
  .panel-warning .panel-body a{
  color:orange;  
  }
</style>
   </body>

  
</html>


<br />
<!-- incident -->

<?php
$sql = 'SELECT id FROM admin WHERE token_site= ?' ;
$req = $bdd->prepare($sql);
$req->execute(array($_GET['token']));
while($row = $req->fetch()) {
$id_user = $row['id'];
}    



    $sql = 'SELECT * FROM incident WHERE id_user = ? AND id = ?' ;
    $req = $bdd->prepare($sql);
    $req->execute(array($id_user,$_GET['id_incident']));
    while($row = $req->fetch()) {
 
       
?>

<div class="container">


<section class="panel panel-warning">
  <header class="panel-heading">
   <h5 class="panel-title">Incident n°<?php echo $row['id']; ?> :  <?php echo $row['titre']; ?></h5>
  </header>
  <div class="panel-body">
   <p><?php echo $row['message']; ?></p>
  </div>
</section>
</div>
<?php } ?>





<?php if ($copy == true){
echo '<div class="footer-copyright text-center py-3">© 2018 Copyright:
      <a href="https://github.com/matiboux/MyMonitor"> Sponsorisé par MyMonitor</a>
    </div>';
} ?>