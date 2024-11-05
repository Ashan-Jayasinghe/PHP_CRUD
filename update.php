<?php
include 'db.php';  // Include the MySQLi connection

$data = json_decode(file_get_contents("php://input"), true);  // Get the input data

// Check if the required fields are present
if (isset($data['id']) && isset($data['name']) && isset($data['email'])) {
    // Prepare the SQL query
    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    
    // Bind the parameters to the SQL query (s = string, i = integer)
    $stmt->bind_param("ssi", $data['name'], $data['email'], $data['id']);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Return success message if the query was successful
        echo json_encode(array('message' => 'User updated successfully.'));
    } else {
        // Return an error message if there was an issue
        echo json_encode(array('message' => 'Failed to update user.'));
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
