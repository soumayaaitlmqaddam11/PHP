<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit ressource</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Edit ressource</h2>

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
            $ressoureceid = $_POST["ressoureceid"];
            $ressourcename = $_POST["ressourcename"];
        

            // Update the user information in the database
            $updateQuery = "UPDATE ressource SET ressourcename='$ressourcename' WHERE ressoureceid=$ressoureceid";

            if ($connection->query($updateQuery) === TRUE) {
                echo "<div class='alert alert-success'>User information updated successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error updating user information: " . $connection->error . "</div>";
            }
        }

        // Retrieve the user information for editing
        if (isset($_GET["id"])) {
            $ressoureceid = $_GET["id"];
            $selectQuery = "SELECT * FROM ressource WHERE ressoureceid = $ressoureceid";
            $result = $connection->query($selectQuery);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
    <form method="post" action="/sqli/ressource/edit.php?id=<?php echo $row["ressoureceid"]; ?>">
    <input type="hidden" name="ressoureceid" value="<?php echo $row["ressoureceid"]; ?>">

    <div class="mb-3">
        <label for="ressourcename" class="form-label">New ressourcename</label>
        <input type="text" class="form-control" name="ressourcename" value="<?php echo $row["ressourcename"]; ?>">
    </div>

   

    <button type="submit" class="btn btn-primary">Update ressource</button>

    <!-- Bouton de retour à la première page (create.php) -->
    <a class='btn btn-secondary' href='/sqli/ressource/index.php'>Back</a>
</form>

                <?php
            } else {
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
