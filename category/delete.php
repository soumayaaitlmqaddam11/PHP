<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sqli";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET["id"])) {
    $categoryID = $_GET["id"];
    
    // Delete the user from the database
    $deleteQuery = "DELETE FROM category WHERE categoryid = $categoryID";
    
    if ($connection->query($deleteQuery) === TRUE) {
    // Rediriger vers la page index.php après l'action
        header("Location:index.php");
    } else {
        echo "<div class='alert alert-danger'>Error deleting user: " . $connection->error . "</div>";
    }
} else {
    echo "<div class='alert alert-danger'>User ID not provided.</div>";
}

// Close the database connection
$connection->close();
?>
