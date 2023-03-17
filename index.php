<?php
include_once "config/database.php";

// set page header
$page_title = "A2PA";
include_once "views/layout_header.php";

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

require 'views/indexView.php';

?>
