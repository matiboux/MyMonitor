<?php
include 'header.php';
include 'db_connect.php';
?>
<?php $user = $_SESSION['login']; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Version 2.0 </small>
 
   
    </h1>
    <ol class="breadcrumb">
<!-- <li><button></button></li> -->
</li>

    </ol>
  </section>

  <!-- Main content -->
 <div class="container">
 

<br /><br />
<!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Titre de l'incident</th>
                      <th>Type</th>
                      <th>statut</th>
                      <th>Modification</th>
                      


                    </tr>

<?php

if (!empty($_GET['delete'])){
  $sql = 'DELETE FROM incident WHERE id = ? AND id_user = ?';    
  $req = $bdd->prepare($sql);
  $req->execute(array($_GET['delete'], $_SESSION['login']));


}

if (!empty($_GET['resolved'])){


  $sql = 'UPDATE incident SET statut = ? WHERE id = ? AND id_user = ? ';    
  $req = $bdd->prepare($sql);
  $req->execute(array('0',$_GET['resolved'],$_SESSION['login']));
echo '<META http-equiv="refresh" content="0; URL=view_incident.php">';


}
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->prepare('SELECT * FROM `incident` WHERE `id_user`= ? ORDER BY id DESC LIMIT 20');
$reponse->execute(array($user));
while ($donnees = $reponse->fetch())
{
?>
                    <tr>
                    <td>#<?php echo $donnees['id']; ?></td>
                    <td><?php echo $donnees['titre']; ?></td>
                    <td><?php echo $donnees['type']; ?></td>
                    <td><?php if($donnees['statut'] == '1'){ echo '<span class="label label-success">Ouvert</span>'; } else{ echo '<span class="label label-danger">Fermé</span>'; }?>
                      <td>
                      <a href="view_incident_edit.php?edit=<?php echo $donnees['id']; ?>"><span class="label label-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span></a>
                      <a href="view_incident.php?resolved=<?php echo $donnees['id']; ?>"><span class="label label-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></span></a>

                      
                      <a href="view_incident.php?delete=<?php echo $donnees['id']; ?>"><span class="label label-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></span></a>
                      
                      </td>
</tr>
<?php

}


$reponse->closeCursor(); // Termine le traitement de la requête


?>


                  </table>
                
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
<META http-equiv="refresh" content="60; URL=view_sites_statut.php">
