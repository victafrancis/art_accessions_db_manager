<!doctype html>
<html lang="en">
  <head>
    <?php include 'inc/head.inc.php' ?>
    <title>Search Results</title>
  </head>


  <body>
  <!-- navbar -->
  <?php include 'inc/navbar.inc.php' ?>


  <div class="container">
  <h3><br>Search Results
    <form method="post" action="export_search.php">
    <input type="hidden" name="search" value="<?php echo get('search'); ?>">
    <button type="submit" class="btn btn-link">Export Search Results</button></form></h3>
  <?php search(get('search'));?>
  </div>
    
  <?php include 'inc/js.inc.php' ?>

  </body>
</html>