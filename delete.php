

<?php 
require './db_connect.php';





$row_id = $_POST['delete_gym_row'];




// Prepare the SQL statement
$stmt = $conn->prepare("DELETE FROM gym_area WHERE id = ?");

// Bind the parameter to the statement
$stmt->bind_param("i", $row_id);


// Execute the statement
$stmt->execute();

// Check if the deletion was successful
if ($stmt->affected_rows > 0) {
    header("Location:./admin.php");
} else {
    header("Location:./admin.php");
}

// Close the statement and the database connection
$stmt->close();
$conn->close();

?>