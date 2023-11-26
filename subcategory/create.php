<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sqli";

$connection = mysqli_connect($servername, $username, $password, $database);

if (isset($_POST['submit'])) {
    $subcategoryname = $_POST["subcategoryname"];
    $categoryid = $_POST["categoryid"];

    do {
        if (empty($subcategoryname) || empty($categoryid)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "INSERT INTO subcategory(subcategoryname, categoryid) VALUES ('$subcategoryname','$categoryid')";
        $result = mysqli_query($connection, $sql);

        if (!$result) {
            $errorMessage = "Invalid query:" . $connection->error;
            break;
        }

        $successMessage = "Subcategory added correctly";
        header("location: /sqli/subcategory/index.php");
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
        <h2>New subcategory</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="subcategoryname">SubcategoryName</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="subcategoryname">
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
            <?php
            if (!empty($successMessage)) {
                echo "
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
                        <a class="btn btn-outline-primary" href="/sqli/subcategory/index.php" role="button">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
