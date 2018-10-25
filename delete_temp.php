<?php
include 'inc/functions.inc.php';
if(isset($_REQUEST['delete'])){
  deleteRecord(FILE_NAME);
  header('Location: index.php');
  exit();
}
?>