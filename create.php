<?php
include 'db.php';  // Include the mysqli connection

$data = json_decode(file_get_contents("php://input"), true);  // Get JSON input

// Check if name and email are provided
if (isset($data['name']) && isset($data['email'])) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    
    // Bind parameters (s means string for both fields)
    $stmt->bind_param("ss", $data['name'], $data['email']);
    
    // Execute the query
    if ($stmt->execute()) {
        // Return success response with the inserted ID
        echo json_encode(array('id' => $conn->insert_id, 'message' => 'User created successfully.'));
    } else {
        // Return an error message in case of query failure
        echo json_encode(array('message' => 'Failed to create user.'));
    }
    
    // Close the statement
    $stmt->close();
} else {
    // Return error message if name or email is missing
    echo json_encode(array('message' => 'Invalid input.'));
}
?>
