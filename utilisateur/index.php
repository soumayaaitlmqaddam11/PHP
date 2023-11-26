<!doctype html>
<html lang="en">
  <head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Hello, world!</title>
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
    <h2>list of users</h2>
    <a class="btn btn-primary" href="/sqli/utilisateur/create.php" role="button">New user</a>
    <br>
    <table class="table">
       <thead>
        <tr>
          <th>UserID</th>
          <th>UserName</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
       </thead>
       <tbody>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database ="sqli";
        // Create connection
        $connection = new mysqli($servername, $username, $password,$database);

         // Check connection
         if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
             }
          //read (récuperer)all row from database table
          $sql ="SELECT * FROM utilisateur";
          $result = $connection->query($sql);

           if(!$result){
                die("Invalid query:". $connection->error);
              }
            while($row = $result->fetch_assoc()){
  echo"
  <tr>
          <td>$row[userid]</td>
          <td>$row[username]</td>
          <td>$row[email]</td>
          
         <td>
         <a class='btn btn-primary' href='/sqli/utilisateur/edit.php?id=$row[userid]'>Edit</a>
         <a class='btn btn-primary' href='/sqli/utilisateur/delete.php?id=$row[userid]'>Delete</a>

          </td>
        </tr>
  ";
}
        ?>
        
       </tbody>
    </table>
  </div>
  </body>
</html>