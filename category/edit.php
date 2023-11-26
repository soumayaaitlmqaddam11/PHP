<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Edit Category</h2>

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
            $categoryID = $_POST["categoryid"];
            $categoryname = $_POST["categoryname"];
        

            // Update the user information in the database
            $updateQuery = "UPDATE category SET categoryname='$categoryname' WHERE categoryid=$categoryID";

            if ($connection->query($updateQuery) === TRUE) {
                echo "<div class='alert alert-success'>User information updated successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error updating user information: " . $connection->error . "</div>";
            }
        }

        // Retrieve the user information for editing
        if (isset($_GET["id"])) {
            $categoryID = $_GET["id"];
            $selectQuery = "SELECT * FROM category WHERE categoryid = $categoryID";
            $result = $connection->query($selectQuery);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
    <form method="post" action="/sqli/category/edit.php?id=<?php echo $row["categoryid"]; ?>">
    <input type="hidden" name="categoryid" value="<?php echo $row["categoryid"]; ?>">

    <div class="mb-3">
        <label for="categoryname" class="form-label">New categoryname</label>
        <input type="text" class="form-control" name="categoryname" value="<?php echo $row["categoryname"]; ?>">
    </div>

   

    <button type="submit" class="btn btn-primary">Update Category</button>

    <!-- Bouton de retour à la première page (create.php) -->
    <a class='btn btn-secondary' href='/sqli/category/index.php'>Back</a>
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
