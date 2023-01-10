<?php 

//  INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'New collections', 'The new collection is there!!!!', current_timestamp());
//connect to the database
$servername="localhost";
$username="root";
$password="";
$database="notes";
$insert = false;

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
  die("Sorry we failed to connect:". mysqli_connect_error());
}


if($_SERVER['REQUEST_METHOD'] == "POST"){
  $title = $_POST["title"];
  $description = $_POST["description"];
  $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title','$description')";
  $result = mysqli_query($conn, $sql);


if($result){
  $insert = true;
}
else{
  echo "The record was not inserted successfully because of this error -->" . mysqli_error($conn);
}
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
        } );
    </script>

    <title>iNotes - Notes taking searching make easy</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">CRUD</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <?php
      if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your record has been inserted.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      

      ?>


      <div class="container my-5">
        <h2>Add a Note</h2>
        <form action="/CRUD/index.php" method="post">
            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" placeholder="Your new note" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Note Description</label>
                <textarea class="form-control" name="description" placeholder="Leave a comment here" id="description" style="height: 100px"></textarea>
              </div>
            <button type="submit" class="btn btn-primary my-3">Add Note</button>
          </form>
      </div>
      </div>



      <!-- Php here -->
      <div class="container my-4">
      <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php 
              $sql ="SELECT * FROM `notes`";   
              $result = mysqli_query($conn, $sql);
              $sno =0;

                while($row= mysqli_fetch_assoc($result)){
                  $sno = $sno + 1;
                  echo "<tr>
                  <th scope='row'>". $sno ."</th>
                  <td>". $row['title'] ."</td>
                  <td>". $row['description'] ."</td>
                  <td><a href='/del'>Delete</a> <a href='/edit'>Edit</a></td>
                </tr>";
                }
                
            ?>
  </tbody>
</table>

      </div>
      <hr>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>