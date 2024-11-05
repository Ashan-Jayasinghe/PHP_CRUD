<?php
include 'db.php';  // Include the MySQLi connection

$data = json_decode(file_get_contents("php://input"), true);  // Get the input data

// Check if the 'id' is provided
if (isset($data['id'])) {
    // Prepare the SQL DELETE statement
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    
    // Bind the 'id' parameter (i = integer)
    $stmt->bind_param("i", $data['id']);
    
    // Execute the query
    if ($stmt->execute()) {
        // Return success message
        echo json_encode(array('message' => 'User deleted successfully.'));
    } else {
        // Return an error message if the query fails
        echo json_encode(array('message' => 'Failed to delete user.'));
    }
    
    // Close the statement
    $stmt->close();
} else {
    // Return an error message if input is invalid
    echo json_encode(array('message' => 'Invalid input.'));
}

// Close the database connection
$conn->close();
?>
