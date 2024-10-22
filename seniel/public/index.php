<?php
// Include the database and developer class
include_once '../config/db.php';
include_once '../classes/Developer.php';

// Initialize the database and developer object
$database = new Database();
$db = $database->getConnection();
$developer = new Developer($db);

// Retrieve the list of developers
$stmt = $developer->read();
$num = $stmt->rowCount();
?>

<!DOCTYPE html>
<html>

<head>
     <title>Developer Registration System</title>
     <link rel="stylesheet" href="assets/style.css">
</head>

<body>
     <h1>REGISTRATION FORM FOR YOUR DREAM JOB</h1>

     <!-- Button to create a new developer -->
     <a href="create.php">Add New Developer</a><br><br>

     <?php
     // Check if there are records to display
     if ($num > 0) {
          echo "<table border='1'>";
          echo "<tr>";
          echo "<th>ID</th>";
          echo "<th>First Name</th>";
          echo "<th>Last Name</th>";
          echo "<th>Profession</th>";
          echo "<th>Email</th>";
          echo "<th>Contact Number</th>";
          echo "<th>Experience (Years)</th>";
          echo "<th>Specialization</th>";
          echo "<th>Date Added</th>";
          echo "<th>Actions</th>";
          echo "</tr>";

          // Fetch and display each row
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
               extract($row);

               echo "<tr>";
               echo "<td>{$id}</td>";
               echo "<td>{$first_name}</td>";
               echo "<td>{$last_name}</td>";
               echo "<td>{$profession}</td>";
               echo "<td>{$email}</td>";
               echo "<td>{$contact_number}</td>";
               echo "<td>{$experience_years}</td>";
               echo "<td>{$specialization}</td>";
               echo "<td>{$date_added}</td>";
               echo "<td>";
               // Update and Delete buttons for each developer
               echo "<a href='update.php?id={$id}'>Edit</a> ";
               echo "<a href='delete.php?id={$id}' onclick=\"return confirm('Are you sure you want to delete this developer?');\">Delete</a>";
               echo "</td>";
               echo "</tr>";
          }

          echo "</table>";
     } else {
          // If no records found, display a message
          echo "<p>No developers found.</p>";
     }
     ?>
</body>

</html>