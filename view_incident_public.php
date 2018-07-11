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
    
<div class="section-messages">
    

</div> 


<div class="section-status">


<div class="alert alert-danger" role="alert"><b><h4><font color="white">Incident n°<?php echo $row['id']; ?> :  <?php echo $row['titre']; ?> </font></h4></b> <br /> <hr><?php echo $row['message']; ?></div>

</div>
</div>
</div>
<?php } ?>

<?php if ($copy == true){
echo '<div class="footer-copyright text-center py-3">© 2018 Copyright:
      <a href="https://github.com/matiboux/MyMonitor"> Sponsorisé par MyMonitor</a>
    </div>'
} ?>