<?php
include 'db.php';  // Include the MySQLi connection

// Prepare the SQL query to fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Fetch all users into an array
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    
    // Return the users in JSON format
    echo json_encode($users);
} else {
    // If no users are found, return an empty array
    echo json_encode(array());
}

// Close the connection
$conn->close();
?>
