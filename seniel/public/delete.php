<?php
// Include the database and Developer class
include_once '../config/db.php';
include_once '../classes/Developer.php';

// Initialize the database and developer object
$database = new Database();
$db = $database->getConnection();
$developer = new Developer($db);

// Get ID of the developer to be deleted
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Developer ID not found.');

// Set developer ID
$developer->id = $id;

// Delete the developer
if ($developer->delete()) {
     echo "<div>Developer was deleted.</div>";
} else {
     echo "<div>Unable to delete developer.</div>";
}
?>

<br>
<a href="index.php">Back to Developer List</a>