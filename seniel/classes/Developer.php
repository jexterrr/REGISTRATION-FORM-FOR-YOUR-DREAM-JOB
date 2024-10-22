<?php
class Developer
{
     private $conn;
     private $table_name = "developers";

     public $id;
     public $first_name;
     public $last_name;
     public $profession;
     public $email;
     public $contact_number;
     public $experience_years;
     public $specialization;
     public $date_added;

     public function __construct($db)
     {
          $this->conn = $db;
     }

     public function read()
     {
          $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
          $stmt = $this->conn->prepare($query);
          $stmt->execute();
          return $stmt;
     }

     // Method to create a new developer record
     public function create()
     {
          // SQL query to insert a new developer
          $query = "INSERT INTO " . $this->table_name . "
                    SET first_name=:first_name, last_name=:last_name, profession=:profession,
                        email=:email, contact_number=:contact_number, experience_years=:experience_years,
                        specialization=:specialization, date_added=NOW()";

          // Prepare the query
          $stmt = $this->conn->prepare($query);

          // Sanitize and bind parameters
          $stmt->bindParam(":first_name", $this->first_name);
          $stmt->bindParam(":last_name", $this->last_name);
          $stmt->bindParam(":profession", $this->profession);
          $stmt->bindParam(":email", $this->email);
          $stmt->bindParam(":contact_number", $this->contact_number);
          $stmt->bindParam(":experience_years", $this->experience_years);
          $stmt->bindParam(":specialization", $this->specialization);

          // Execute the query and check if successful
          if ($stmt->execute()) {
               return true;
          }

          return false;
     }

     // Method to get a single developer record
     public function readOne()
     {
          $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
          $stmt = $this->conn->prepare($query);
          $stmt->bindParam(1, $this->id);
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          $this->first_name = $row['first_name'];
          $this->last_name = $row['last_name'];
          $this->profession = $row['profession'];
          $this->email = $row['email'];
          $this->contact_number = $row['contact_number'];
          $this->experience_years = $row['experience_years'];
          $this->specialization = $row['specialization'];
     }

     // Method to update a developer record
     public function update()
     {
          $query = "UPDATE " . $this->table_name . "
               SET first_name = :first_name, last_name = :last_name, profession = :profession,
                   email = :email, contact_number = :contact_number, experience_years = :experience_years,
                   specialization = :specialization
               WHERE id = :id";

          $stmt = $this->conn->prepare($query);

          // Bind new values
          $stmt->bindParam(":first_name", $this->first_name);
          $stmt->bindParam(":last_name", $this->last_name);
          $stmt->bindParam(":profession", $this->profession);
          $stmt->bindParam(":email", $this->email);
          $stmt->bindParam(":contact_number", $this->contact_number);
          $stmt->bindParam(":experience_years", $this->experience_years);
          $stmt->bindParam(":specialization", $this->specialization);
          $stmt->bindParam(":id", $this->id);

          if ($stmt->execute()) {
               return true;
          }

          return false;
     }

     public function delete()
     {
          $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

          // Prepare query
          $stmt = $this->conn->prepare($query);

          // Bind the developer ID
          $stmt->bindParam(":id", $this->id);

          if ($stmt->execute()) {
               return true;
          }

          return false;
     }
}
