<?php
include_once "config/database.php";

// set page header
$page_title = "A2PA";

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

include_once "views/layout_header.php";

include_once 'views/indexview.php';

include_once "views/layout_footer.php"; ?>



?>
