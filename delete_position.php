<?php
require_once 'config.php';
// array for JSON response
$response = array();
$con= mysqli_connect($server,$user,$mp,$database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $id = $_POST['idPosition'];

    // Validate that required fields are not empty
    if (!empty($id)) {
        // Prepare the SQL insert query
        $sql = "DELETE from position where idPosition=?";

        // Initialize the prepared statement
        $stmt = mysqli_prepare($con, $sql);

        if ($stmt) {
            // Bind parameters to the SQL query
            mysqli_stmt_bind_param($stmt, "s", $id);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Position deleted successfully.";
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($con);
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method. Use POST.";
}

// Close the database connection
mysqli_close($con);
?>