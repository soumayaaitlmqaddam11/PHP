<?php
$servername = "localhost";
$username = "root";
$password = "";
$database ="sqli";
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT subcategoryid, subcategoryname, categoryname FROM subcategory JOIN category ON category.categoryid = subcategory.categoryid";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query:" . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sqli</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        /* Barre de navigation (Navbar) */
        .navbar {
            background-color: #3498db;
            
        }

        .navbar-brand {
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
        }

        .navbar-nav .nav-link:hover {
            color: #f1c40f;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/sqli/utilisateur/index.php">Utilisateur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sqli/category/index.php">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sqli/ressource/index.php">Ressource</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sqli/subcategory/index.php">Subcategory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sqli/statistics/index.php">Statistics</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        <h2>List of subcategories</h2>
        <a class="btn btn-primary" href="/sqli/subcategory/create.php" role="button">New Subcategory</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>SubCategoryID</th>
                    <th>Subcategory Name</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['subcategoryid']}</td>
                        <td>{$row['subcategoryname']}</td>
                        <td>{$row['categoryname']}</td>
                        <td>
                            <a class='btn btn-primary' href='/sqli/subcategory/edit.php?id={$row['subcategoryid']}'>Edit</a>
                            <a class='btn btn-primary' href='/sqli/subcategory/delete.php?id={$row['subcategoryid']}'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
