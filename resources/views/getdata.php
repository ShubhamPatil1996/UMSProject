<?php
// Get config file
require("config.php"); 

// Get and sanitize the country ID from the GET request.
$countryId = filter_input(INPUT_GET, "country_code", FILTER_SANITIZE_STRING);

// Check if the countryId is empty after sanitization.
if (empty($countryId)) {
  die("Invalid country code.");
}

// Create the SQL query to retrieve states based on the country ID.
$sql = "SELECT state_code, state_name FROM tbl_states WHERE country_code = '$countryId'";

// Execute the query.
$result = mysqli_query($conn, $sql);

// Convert the result set to an array.
$states = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Echo the JSON response.
echo json_encode($states);

// Close the database connection.
mysqli_close($conn);
?>