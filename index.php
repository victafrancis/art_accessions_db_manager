<!doctype html>
<html lang="en">
  <head>
    <?php include 'inc/head.inc.php' ?>
    <title>Accession Registration Database for Ontario Art Collections</title>
  </head>


  <body>
  <!-- navbar -->
  <?php include 'inc/navbar.inc.php' ?>

  <div class="container">
  <h3><br>Government of Ontario Art Collections Accessions</h3>
  <?php makeTable(FILE_NAME);?>
  </div>

  <?php include 'inc/footer.inc.php' ?> 
     
  <?php include 'inc/js.inc.php' ?>

  </body>
</html>