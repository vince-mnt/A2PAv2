<?php
include_once "config/database.php";

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

include_once "views/layout_header.php"; 

include_once "includes/graph/graph.php";

include_once "views/layout_footer.php"; 

?>