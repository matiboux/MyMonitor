<?php
include 'db_connect.php';
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>MyMonitor</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b>My</b>Monitor</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Connectez-vous ! </p>


        <?php
        // on teste si le visiteur a soumis le formulaire de connexion
        if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
            if ((isset($_POST['mail']) && !empty($_POST['mail'])) && (isset($_POST['pass_md5']) && !empty($_POST['pass_md5']))) {

            $base = mysql_connect ($bdd_host, $bdd_user, $bdd_password);
            mysql_select_db ($bdd_db, $base);

            // on teste si une entrée de la base contient ce couple mail / pass
            $sql = 'SELECT count(*) FROM admin WHERE mail="'.mysql_escape_string($_POST['mail']).'" AND pass_md5="'.mysql_escape_string(md5($_POST['pass_md5'])).'"';
            $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
            $data = mysql_fetch_array($req);

            mysql_free_result($req);
            mysql_close();

            // si on obtient une réponse, alors l'utilisateur est un membre
            if ($data[0] == 1) {
                session_start();
                $_SESSION['login'] = $_POST['mail'];
                header('Location: index.php');
                exit();
            }
            // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son mail, soit dans son mot de passe
            elseif ($data[0] == 0) {
                $erreur = '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Error !</h4>
                  Utilisateur ou mot de passe incorrect !
                  </div>';
            }
            // sinon, alors la, il y a un gros problème :)
            else {
                $erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
            }
            }
            else {
            $erreur = 'Au moins un des champs est vide.';
            }
        }
        ?>
        <form action="login.php" method="post">
          <div class="form-group has-feedback">

            <input type="login" class="form-control" placeholder="mail" name="mail" value="<?php if (isset($_POST['mail'])) echo htmlentities(trim($_POST['mail'])); ?>"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="pass_md5" value="<?php if (isset($_POST['pass_md5'])) echo htmlentities(trim($_POST['pass_md5'])); ?>"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">

              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="connexion" type="submit" value="Connexion">Connexion</button>

          </div><!-- /.col -->
          </div>
        </form>
<a href="register.php">Se créer un compte</a>



      </div><!-- /.mail-box-body -->
    </div><!-- /.mail-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
