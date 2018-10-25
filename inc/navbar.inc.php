<?php
  $search = isset($_POST['search']) ? $_POST['search'] : "Search";
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
<!-- <a class="navbar-brand" href="#">Navbar</a> -->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="index.php" title="Home">Home </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="add_record.php" title="Add New Record">Add New Record</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="import_data.php" title="Import Data">Import Data</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="export_data.php" title="Export Data">Export Data</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="author.php" title="About the Author">Author</a>
    </li>
  </ul>
  <form method="get" action="search_page.php" class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="<?php echo $search ?>" aria-label="Search" name="search" required>
    <button class="btn btn btn-outline-dark my-2 my-sm-0" type="submit"><i class="tiny material-icons">search</i></button>
  </form>
</div>
</div>
</nav>