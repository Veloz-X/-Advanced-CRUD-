<?php 
  include 'action.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> 
</head>

<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Navbar</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul>
  </div>
  <form class="form-inline" action="/action_page.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-success mr-sm-2" type="submit">Search</button>
  </form>
  <form class="form-inline " action="/prueba.php">
    <button class="btn btn-warning" type="submit">PRUEBA</button>
  </form>
</nav> 
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <!-- <hr>     -->
        <h3 class="text-center text-dark mt-2">Hola Mundo</h3>
            <hr>
            <?php if(isset($_SESSION['response'])){ ?> 
            <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= $_SESSION['response']; ?>
            </div>
            <?php } unset($_SESSION['response']);?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-center text-info">Add Record</h3>
            <form action="action.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $id; ?>">
            <div class="form-group">
                <input type="text" name="name" value="<?= $name; ?>" class="form-control" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <input type="text" name="email" value="<?= $email; ?>" class="form-control" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <input type="tel" name="phone" value="<?= $phone; ?>" class="form-control" placeholder="Enter phone" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="oldimage" value="<?= $photo; ?>">
                <input type="file" name="image" class="custom-file" >
                <img src="<?= $photo;?>" width="120" class="img-thumbnail">
            </div>
            <div class="form-group">
              <?php if($update==true){ ?>
                <input type="submit" name="update" class="btn btn-success btn-block" value="Update">
              <?php }else{ ?>
                <input type="submit" name="add" class="btn btn-primary btn-block" value="add Record">
              <?php  }?>
            </div>
            </form>
        </div>
        <div class="col-md-8">
          <?php 
            $query="SELECT * FROM crud";
            $stmt=$conn->prepare($query);
            $stmt->execute();
            $result=$stmt->get_result();
          ?>
            <h3 class="text-center text-info">Records Present In The database
            </h3>
            <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row=$result->fetch_assoc()){ ?>
      <tr>
        <td><?= $row['id']; ?></td>
        <td><img src="<?= $row['photo']; ?>"  width="25" ></td>
        <td><?= $row['name']; ?></td>
        <td><?= $row['email']; ?></td>
        <td><?= $row['phone']; ?></td>
        <td>
            <a href="details.php?details=<?= $row['id']; ?>" class="badge badge-primary p-1">Details</a> |
            <a href="action.php?delete=<?= $row['id']; ?>" class="badge badge-danger p-1" 
            onclick="return confirm('Quieres Eliminar'); ">Delete</a> |
            <a href="index.php?edit=<?= $row['id']; ?>" class="badge badge-success p-1">Edit</a>
        </td>
      </tr>
      <?php }?>
    </tbody>
  </table>
        </div>
    </div>
</div>
</body>

</html>