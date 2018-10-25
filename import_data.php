
<!doctype html>
<html lang="en">
  <head>
    <?php include 'inc/head.inc.php' ?>
    <title>Import Data</title>
  </head>


  <body>
  <!-- navbar -->
  <?php include 'inc/navbar.inc.php' ?>

    <div class="container">
        <h3><br>Import Data</h3>

        <div class="container"><br>
            <form method='post' enctype='multipart/form-data' action='upload.php'>
                Select a file to import <input type='file' name='userfile' required/><br>
                <button type='submit' name='submit' class='btn btn-primary'>Import</button>
            </form>
        </div>
    </div>

  <?php include 'inc/js.inc.php' ?>

  </body>
</html>