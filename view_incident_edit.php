<?php
include 'header.php';
include 'db_connect.php';
?>

<script type="text/javascript" src="assets/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "paste,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage," +
                    "advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace," +
                    "print,contextmenu,directionality,fullscreen,noneditable,visualchars,nonbreaking," +
                    "xhtmlxtras,template,wordcount,advlist,visualblocks",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,|,insertdate,inserttime,preview,|,forecolor,backcolor,hr",

        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false,
        add_unload_trigger: false,

        theme_advanced_default_font_size : '10pt',
        theme_advanced_default_font_family : 'Verdana',
        theme_advanced_fonts : "Andale Mono=andale mono,monospace;Arial=arial,helvetica,sans-serif;Arial Black=arial black,sans-serif;Book Antiqua=book antiqua,palatino,serif;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier,monospace;Georgia=georgia,palatino,serif;Helvetica=helvetica,arial,sans-serif;Impact=impact,sans-serif;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco,monospace;Times New Roman=times new roman,times,serif;Trebuchet MS=trebuchet ms,geneva,sans-serif;Verdana=verdana,geneva,sans-serif;Webdings=webdings;Wingdings=wingdings,zapf dingbats",
        theme_advanced_font_sizes : '8pt,9pt,10pt,11pt,12pt,14pt,16pt,18pt,20pt,22pt,24pt,28pt,36pt',
        paste_retain_style_properties: 'font-size,font-family,color',
        paste_remove_styles_if_webkit: false,

        powerpaste_word_import: 'merge',
        powerpaste_html_import: 'clean',
        powerpaste_allow_local_images: false,

        // Replace values for the template plugin
        template_replace_values : {
            username : "Some User",
            staffid : "991234"
        }
    });
</script>
<!-- /TinyMCE -->

<div class="wrapper row-offcanvas row-offcanvas-left">
<style type="text/css">
	.icon_img{
		width: 20px;
		height: 18px;
	}
	a span.mm-text{
		font-weight: bold;
	    font-size: 16px;
	    position: absolute;
        top: 11px;
        left: 50px;
	}
</style>



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

if ($_POST){


  $sql = 'UPDATE incident SET titre = ?, message = ?, type = ?, statut = ? WHERE id = ? AND id_user = ?';    
  $req = $bdd->prepare($sql);
  $req->execute(array($_POST['titre'],$_POST['message'],$_POST['type'],'1',$_GET['edit'],$_SESSION['login']));


echo '<div class="callout callout-success">
<h4>F&eacute;licitations !</h4>

<p>L\'incident vient d\' etre mis à jour !</p>
</div>';
}


  

    ?>



<?php
$sql = 'SELECT * FROM incident WHERE id= ? AND id_user = ?' ;
$req = $bdd->prepare($sql);
$req->execute(array($_GET['edit'],$_SESSION['login']));
while($row = $req->fetch()) {
?>

    <form action="view_incident_edit.php?edit=<?php echo $row['id']; ?>" method="POST">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Titre de l'incident*</label>

                      
                      <input maxlength="200" class="form-control" name="titre" placeholder="" type="text" value="<?php echo $row['titre']; ?>">
                      <label>Categorie*</label>
                      <select class="form-control" id="exampleFormControlSelect2" name="type">


              <?php if ($row['type'] == 'server'){
echo '<option value="server">Serveur</option>';

              }elseif($row['type'] == 'site'){

                echo '<option value="site">Site</option>';
              }    
?>


              
    </select>
    <label>Description de l'incident*</label>
    <textarea id="message" class="form-control" rows="3" name="message"><?php echo $row['message']; ?></textarea>
                    
                    </div>
                    <!-- textarea -->

         <center>
              <input type="submit" class="btn btn-primary btn-block btn-flat" type="submit" value="Soumettre" name="Soumettre">
</center>
<font color "red"> * = Obligatoire</font>
          </div>
        </form>
<?php } ?>

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
