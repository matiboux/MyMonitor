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
 <div class="container">



<!-- /.box-header -->
                <div class="box-body table-responsive no-padding">



<?php
$user = $_SESSION['login'];
?>
<font color="red">Attention : les champs ne doivent pas rester vides !</font>


















	<?php
    // on teste si le visiteur a soumis le formulaire
    if (isset($_POST['Soumettre']) && $_POST['Soumettre'] == 'Soumettre') {
    	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
    	if ((isset($_POST['nom']) && !empty($_POST['description'])) && (isset($_POST['IP']) && !empty($_POST['description']))) {
    	// on teste les deux mots de passe
    	if ($_POST['IP'] != $_POST['IP']) {
    		$erreur = 'ERROR 2.';
    	}
    	else {
    		$base = mysql_connect ($bdd_host, $bdd_user, $bdd_password);
    		mysql_select_db ($bdd_db, $base);

    		// on recherche si ce login est déjà utilisé par un autre membre
    		$sql = 'SELECT count(*) FROM servers WHERE nom="'.mysql_escape_string($_POST['IP']).'"';
    		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    		$data = mysql_fetch_array($req);

    		if ($data[0] == 0) {
    		$sql = 'INSERT INTO servers VALUES("", "'.mysql_escape_string($_POST['nom']).'", "'.mysql_escape_string($_POST['IP']).'", "'.mysql_escape_string($_POST['description']).'", "'.mysql_escape_string($user).'", "'.mysql_escape_string($_POST['port']).'")';
    		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
    		echo '<META http-equiv="refresh" content="0; URL=myservers.php">';
    		exit();
    		}
    		else {
    		$erreur = 'ERROR 3';
    		}
    	}
    	}
    	else {
    	$erreur = 'ERROR 4';
    	}
    }

    ?>




























    <form action="addserver.php" method="POST">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Nom*</label>
                      <input maxlength="10" class="form-control" value="<?php if (isset($_POST['nom'])) echo htmlentities(trim($_POST['titre'])); ?>" name="nom" placeholder="" type="text">
                    </div>
                    <div class="form-group">
                      <label>Description*</label>
                      <input maxlength="35" class="form-control" value="<?php if (isset($_POST['description'])) echo htmlentities(trim($_POST['description'])); ?>" name="description" placeholder="" type="text">
                    </div>
                    <div class="form-group">
                      <label>IP*</label>
                      <input class="form-control" value="<?php if (isset($_POST['IP'])) echo htmlentities(trim($_POST['IP'])); ?>" name="IP" placeholder=""  type="text">
                    </div>
                    <div class="form-group">
                      <label>Port*</label>
                      <input class="form-control" value="<?php if (isset($_POST['port'])) echo htmlentities(trim($_POST['port'])); ?>" name="port" placeholder=""  type="text">
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
