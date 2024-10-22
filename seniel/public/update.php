<?php
// Include the database and Developer class
include_once '../config/db.php';
include_once '../classes/Developer.php';

// Initialize the database and developer object
$database = new Database();
$db = $database->getConnection();
$developer = new Developer($db);

// Get ID of the developer to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Developer ID not found.');

// Set ID property of developer to be edited
$developer->id = $id;

// Get the current data of the developer
$developer->readOne();

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

     // Update the developer
     if ($developer->update()) {
          echo "<div>Developer was updated.</div>";
     } else {
          echo "<div>Unable to update developer.</div>";
     }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Edit Developer</title>
</head>

<body>
     <h1>Edit Developer</h1>

     <!-- Form to edit a developer -->
     <form action="update.php?id=<?php echo $id; ?>" method="post">
          <label for="first_name">First Name:</label><br>
          <input type="text" name="first_name" value="<?php echo $developer->first_name; ?>" required><br><br>

          <label for="last_name">Last Name:</label><br>
          <input type="text" name="last_name" value="<?php echo $developer->last_name; ?>" required><br><br>

          <label for="profession">Profession:</label><br>
          <input type="text" name="profession" value="<?php echo $developer->profession; ?>" required><br><br>

          <label for="email">Email:</label><br>
          <input type="email" name="email" value="<?php echo $developer->email; ?>" required><br><br>

          <label for="contact_number">Contact Number:</label><br>
          <input type="text" name="contact_number" value="<?php echo $developer->contact_number; ?>" required><br><br>

          <label for="experience_years">Experience (Years):</label><br>
          <input type="number" name="experience_years" value="<?php echo $developer->experience_years; ?>" required><br><br>

          <label for="specialization">Specialization:</label><br>
          <input type="text" name="specialization" value="<?php echo $developer->specialization; ?>" required><br><br>

          <input type="submit" value="Update">
     </form>

     <br>
     <a href="index.php">Back to Developer List</a>
</body>

</html>