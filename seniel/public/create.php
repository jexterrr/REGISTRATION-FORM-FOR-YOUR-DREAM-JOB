<?php
// Include the database and Developer class
include_once '../config/db.php';
include_once '../classes/Developer.php';

// Initialize the database and developer object
$database = new Database();
$db = $database->getConnection();
$developer = new Developer($db);

// Check if the form was submitted
if ($_POST) {
     // Set developer property values
     $developer->first_name = htmlspecialchars(strip_tags($_POST['first_name']));
     $developer->last_name = htmlspecialchars(strip_tags($_POST['last_name']));
     $developer->profession = htmlspecialchars(strip_tags($_POST['profession']));
     $developer->email = htmlspecialchars(strip_tags($_POST['email']));
     $developer->contact_number = htmlspecialchars(strip_tags($_POST['contact_number']));
     $developer->experience_years = htmlspecialchars(strip_tags($_POST['experience_years']));
     $developer->specialization = htmlspecialchars(strip_tags($_POST['specialization']));

     // Create a new developer
     if ($developer->create()) {
          echo "<div>Developer record was created.</div>";
     } else {
          echo "<div>Unable to create developer record.</div>";
     }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Add New Developer</title>
     <link rel="stylesheet" href="assets/style.css">
</head>

<body>

     <h1>Add New Developer</h1>

     <!-- Form to add a new developer -->
     <form action="create.php" method="post">
          <label for="first_name">First Name:</label><br>
          <input type="text" name="first_name" required><br><br>

          <label for="last_name">Last Name:</label><br>
          <input type="text" name="last_name" required><br><br>

          <label for="profession">Profession:</label><br>
          <input type="text" name="profession" required><br><br>

          <label for="email">Email:</label><br>
          <input type="email" name="email" required><br><br>

          <label for="contact_number">Contact Number:</label><br>
          <input type="text" name="contact_number" required><br><br>

          <label for="experience_years">Experience (Years):</label><br>
          <input type="number" name="experience_years" required><br><br>

          <label for="specialization">Specialization:</label><br>
          <input type="text" name="specialization" required><br><br>

          <input type="submit" value="Save">
     </form>

     <br>
     <a href="index.php">Back to Developer List</a>

</body>

</html>