<!doctype html>
<html lang="en">
  <head>
    <?php include 'inc/head.inc.php' ?>
    <title>Delete Record</title>
  </head>


  <body>
  <!-- navbar -->
  <?php include 'inc/navbar.inc.php' ?>

    <div class="container">
    <h3><br>Delete this record?</h3>

        <!-- input form -->
    <div class="container"><br>
        <form action="delete_temp.php" method="get">
        <input type="hidden" name="id" value="<?php echo get('id'); ?>">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Date</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Date" name="date" value="<?php echo get('date')?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Type</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Type" name="type" value="<?php echo get('type')?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Artist</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Artist" name="artist" value="<?php echo get('artist')?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Title" name="title" value="<?php echo get('title')?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Accession #</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="Accession #" name="accession" value="<?php echo get('accession')?>" readonly>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
            <button type="submit" value="edit" formaction="edit_record.php" class="btn btn-primary" name="edit">Edit</button>
            <button type="submit" value="submit" class="btn btn-primary" name="delete">Delete</button>
            <a href="index.php"><button type="button" class="btn btn-secondary">Back</button></a>
            </div>
        </div>
        </form>
    </div>
        <!-- end of input form -->
    </div>

    <?php include 'inc/js.inc.php' ?>
    
  </body>
</html>