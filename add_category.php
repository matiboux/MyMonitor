<?php
include 'header.php';
include 'db_connect.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Accueil</a></li>
    </ol>
  </section>

  <!-- Main content -->
 <div class="container-fluid">



<!-- /.box-header -->
                <div class="box-body table-responsive no-padding">



<?php
$user = $_SESSION['login'];
?>
<font color="red">Attention : les champs ne doivent pas rester vides !</font>


<?php

if (!empty($_POST['category'])){

  $tab = array(
    "id_user" => $_SESSION['login'], 
    "name_category" => $_POST['category'],
    "type" => $_POST['type']
);
$sql = 'INSERT INTO category (id_user,name_category,type) VALUES (:id_user, :name_category, :type)' ;
$req = $bdd->prepare($sql);
$result = $req->execute($tab);

  

echo '<div class="callout callout-success">
<h4>F&eacute;licitations !</h4>

<p>La catégorie vient d\' etre ajout&eacute; !</p>
</div>';
}


  

    ?>





    <form action="add_category.php" method="POST">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Nom de la catégorie*</label>
                      <input maxlength="200" class="form-control" name="category" placeholder="" type="text">
                      <div class="form-group">
    <label>Type</label>
    <select multiple class="form-control" name="type">
      <option value="site">Site</option>
      <option value="server">Server</option>
    </select>
  </div>
    
    </select>
                    
                    </div>
                    <!-- textarea -->

         <center>
              <input type="submit" class="btn btn-primary btn-block btn-flat" type="submit" value="Soumettre" name="Soumettre">
</center>
<font color "red"> * = Obligatoire</font>
          </div>
        </form>


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
