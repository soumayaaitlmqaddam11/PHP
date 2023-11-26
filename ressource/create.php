<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sqli";

// Create connection entre php et la base de données en utilison la fonction mysqli_connect
$connection = mysqli_connect($servername, $username, $password, $database);
// $connection = new mysqli($servername, $username, $password, $database);

// isset il fait la véréfication en php
if (isset($_POST['submit'])) {
    $ressourcename = $_POST["ressourcename"];
    $categoryid = $_POST["categoryid"];
    $subcategoryid = $_POST["subcategoryid"];

    do {
        if (empty($ressourcename)||empty($categoryid) || empty($subcategoryid)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // add new user to database
        $sql = "INSERT INTO ressource(ressourcename,subcategoryid, categoryid) VALUES ('$ressourcename','$subcategoryid','$categoryid')";
        // lire les requetes sql en utilisant mysqli_query
        $result = mysqli_query($connection, $sql);
        // $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query:" . $connection->error;
            break;
        }

        $successMessage = "Client added correctly";
        header("location: /sqli/ressource/index.php");
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sqli</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div class="container my-5">
    <h2>New ressource</h2>
    <?php
    if(!empty($errorMessage)){
        echo"
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>$errorMessage</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
      ";
    }
    ?>
    <!-- les informations qui j'entre seront sécurisés avec la methode poste -->
    <form method="post">
<div class=" row mb-3">
  <div class=" row mb-3">
        <label class="col-sm-3 col-form-label" for="ressourcename">RessourceName</label>
        <div class="col-sm-6">
            <input type="text" class="form-control"name="ressourcename">
            </div>
    </div>
    <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="categoryid">CategoryName</label>
                <div class="col-sm-6">
                    <select class="form-select" name="categoryid">
                        <?php
                        $categoryQuery = "SELECT categoryid, categoryname FROM category";
                        $categoryResult = mysqli_query($connection, $categoryQuery);

                        if ($categoryResult) {
                            while ($category = mysqli_fetch_assoc($categoryResult)) {
                                echo "<option value='{$category['categoryid']}'>{$category['categoryname']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="subcategoryid">SubcategoryName</label>
                <div class="col-sm-6">
                    <select class="form-select" name="subcategoryid">
                        <?php
                        $categoryQuery = "SELECT subcategoryid, subcategoryname FROM subcategory";
                        $categoryResult = mysqli_query($connection, $categoryQuery);

                        if ($categoryResult) {
                            while ($category = mysqli_fetch_assoc($categoryResult)) {
                                echo "<option value='{$category['subcategoryid']}'>{$category['subcategoryname']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
     </div>
    
     <?php
     if(!empty($successMessage)){
        echo"
        <div class='row mb-3'>
        <div class='offset-sm-3 col-sm-6'>
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>$successMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        </div>
        </div>
        ";
     }
     ?>
<div class="row mb-3">
    <div class="offset-sm-3 col-sm-3">
        <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="d-grid">
            <a class="btn btn-outline-primary" href="/sqli/ressource/index.php" role="button">Cancel</a>
        </div>
    </div>
</div>
    </form>
</div>
    
   
</body>
</html>