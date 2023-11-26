<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Dashboard</title>
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
    <!-- Barre de navigation -->
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
   
    <!-- Contenu principal -->
    <div class="content">
        <div class="container my-5">
            <h2 class="text-center mb-4">Dashboard</h2>
            <div class="row">
                <?php
                // Connexion à la base de données
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "sqli";

                // Créer la connexion
                $connection = new mysqli($servername, $username, $password, $database);

                // Vérifier la connexion
                if ($connection->connect_error) {
                    die("La connexion a échoué : " . $connection->connect_error);
                }

                // Requêtes SQL pour obtenir les statistiques
                $sqlTotalUsers = "SELECT COUNT(*) as total_users FROM utilisateur";
                $resultTotalUsers = $connection->query($sqlTotalUsers);
                $rowTotalUsers = $resultTotalUsers->fetch_assoc();

                $sqlTotalCategories = "SELECT COUNT(*) as total_categories FROM category";
                $resultTotalCategories = $connection->query($sqlTotalCategories);
                $rowTotalCategories = $resultTotalCategories->fetch_assoc();

                $sqlTotalRessources = "SELECT COUNT(*) as total_ressources FROM ressource";
                $resultTotalRessources = $connection->query($sqlTotalRessources);
                $rowTotalRessources = $resultTotalRessources->fetch_assoc();

                $sqlTotalSubcategories = "SELECT COUNT(*) as total_subcategories FROM subcategory";
                $resultTotalSubcategories = $connection->query($sqlTotalSubcategories);
                $rowTotalSubcategories = $resultTotalSubcategories->fetch_assoc();
                ?>

                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Utilisateurs</h5>
                            <p class="card-text"><?php echo $rowTotalUsers['total_users']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Categorys</h5>
                            <p class="card-text"><?php echo $rowTotalCategories['total_categories']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Ressources</h5>
                            <p class="card-text"><?php echo $rowTotalRessources['total_ressources']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h5 class="card-title">Subcategorys</h5>
                            <p class="card-text"><?php echo $rowTotalSubcategories['total_subcategories']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Fermer la connexion à la base de données à la fin de votre script
    $connection->close();
    ?>

</body>
</html>
