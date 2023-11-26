<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Edit User</h2>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "sqli";

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the form data
            $userID = $_POST["UserID"];
            $newUserName = $_POST["newUserName"];
            $newEmail = $_POST["newEmail"];

            // Update the user information in the database
            $updateQuery = "UPDATE utilisateur SET username='$newUserName', email='$newEmail' WHERE userid=$userID";

            if ($connection->query($updateQuery) === TRUE) {
                echo "<div class='alert alert-success'>User information updated successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error updating user information: " . $connection->error . "</div>";
            }
        }

        // Retrieve the user information for editing
        if (isset($_GET["id"])) {
            $userID = $_GET["id"];
            $selectQuery = "SELECT * FROM utilisateur WHERE userid = $userID";
            $result = $connection->query($selectQuery);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
    <form method="post" action="/sqli/utilisateur/edit.php?id=<?php echo $row["userid"]; ?>">
    <input type="hidden" name="UserID" value="<?php echo $row["userid"]; ?>">

    <div class="mb-3">
        <label for="newUserName" class="form-label">New UserName</label>
        <input type="text" class="form-control" name="newUserName" value="<?php echo $row["username"]; ?>">
    </div>

    <div class="mb-3">
        <label for="newEmail" class="form-label">New Email</label>
        <input type="text" class="form-control" name="newEmail" value="<?php echo $row["email"]; ?>">
    </div>

    <button type="submit" class="btn btn-primary">Update User</button>
    

    <!-- Bouton de retour à la première page (create.php) -->
    <a class='btn btn-secondary' href='/sqli/utilisateur/index.php'>Back</a>
</form>

                <?php
                       } 
            else {
                echo "<div class='alert alert-danger'>User not found.</div>";
            }
        }

        // Close the database connection
        $connection->close();
        ?>
        
        <!-- Bouton de retour à la première page (create.php) -->
    </div>
</body>
</html>
