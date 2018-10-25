
<!doctype html>
<html lang="en">
  <head>
    <?php include 'inc/head.inc.php' ?>
    <title>Edit a Record</title>
  </head>


  <body>
  <!-- navbar -->
  <?php include 'inc/navbar.inc.php' ?>

    <div class="container">
    <h3><br>Edit Record</h3>

        <!-- input form -->
    <div class="container"><br>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <input type="hidden" name="id" value="<?php echo get('id'); ?>">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Date</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Date" name="date" value="<?php echo get('date')?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Type</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Type" name="type" value="<?php echo get('type')?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Artist</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Artist" name="artist" value="<?php echo get('artist')?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Title" name="title" value="<?php echo get('title')?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Accession #</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="Accession #" name="accession" value="<?php echo get('accession')?>" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
            <button type="button" value="submit" class="btn btn-primary" data-toggle="modal" data-target="#editRecordModal">Submit</button>
            <a href="index.php"><button type="button" class="btn btn-secondary">Back</button></a>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editRecordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name='submitEdit'>Continue</button>
                </div>
                </div>
            </div>
        </div>
        </form>
    </div>
        <!-- end of input form -->
    </div>

   <?php include 'inc/js.inc.php' ?>
   
  </body>
</html>

<?php
if(isset($_REQUEST['submitEdit'])){
  editRecord(FILE_NAME);
}
?>