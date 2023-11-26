<?php
include "connect.php";

$sql = "SELECT ressource1.ResourceID , ressource1.Nom , ressource1.categoryID CategoryID_f  , category.CategoryName  CategoryName
, sub_category.SubCategoryID sub_f , sub_category.SubCategoryName

FROM ressource1
 LEFT JOIN category ON
 ressource1.categoryID = category.categoryID  
 LEFT JOIN  sub_category ON 
 ressource1.subcategoryID = sub_category.SubCategoryID;";

$result = mysqli_query($conn , $sql);


if(isset($_GET['ResourceID'])){

    $id = $_GET['ResourceID'] ;   
    $Delete = "DELETE FROM ressource1 WHERE ResourceID = $id" ; 
    $result1 = mysqli_query($conn , $Delete);


    if ($result1) {
        header("Location: Ressources.php?msg=L'utilisateur a éte suprimmer");
      } else {
        echo "Failed: " . mysqli_error($conn);
      }   

  } 
  
  if (isset($_POST['submit'])) {
    
          $Nom = $_POST['Nom'];
        
  
          $sqlADD = "INSERT INTO `ressource1`(`Nom`) VALUES ('$Nom')";
          $ResultADD = mysqli_query($conn, $sqlADD);
  
          if ($ResultADD) {
              header("Location: Ressources.php?msg=Le Category a éte Ajouter avec succes");

          } else {
              echo "Failed: " . mysqli_error($conn);
          }
      } 


mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link rel="shortcut icon" href="images/logo.avif" type="image/x-icon">

		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="style.css">
<style>
		
</style>

</head>

<body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<h1><a href="index.php" class="logo">NB</a></h1>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="index.php"><span class="fa fa-home"></span> Home</a>
          </li>
          <li>
              <a href="User.php"><span class="fa fa-user"></span> Utilisateur</a>
          </li>

          <li>
            <a href="Category.php"><span class="fa fa-sticky-note"></span>Category</a>
          </li>
       
          <li>
            <a href="subcategory.php"><span class="fa fa-cogs"></span>SubCategory</a>
          </li>
         
          <li>
            <a href="Ressources.php"><span class="fa fa-paper-plane"></span>Ressources</a>
          </li>
        </ul>


       
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>


  <?php
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        '.$msg.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'
   ; };

?>
	<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title bg-primary" >
				<div class="row">
					<div class="col-sm-6">
						<h2 id="SQLI">SQLI<b>i</b>-Ressource</h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							ID
						</th>
						<th>Nom De Sub Category</th>
						<th>Nom De Category</th>
						<th>Nom De SubCategory</th>
						
						<th>Edit/Supprimer</th>
					</tr>
				</thead>
				<tbody>
            <?php
            while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><?php echo $row['ResourceID']?></td>


                    <td><?php echo $row['Nom']?></td>
                    <td><?php 
                    if($row['CategoryID_f'] == NULL){
                      echo "_" ;}
                    else echo $row['CategoryName'];              
                    ?></td>

                    <td><?php 
                    if($row['sub_f'] == NULL){
                      echo "_" ;}
                    else echo $row['SubCategoryName'];              
                    ?></td>
                    
                    <td><a href="UpdateRessources.php?ResourceID=<?php echo $row['ResourceID'] ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href="Ressources.php?ResourceID=<?php echo $row['ResourceID'] ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a></td>

                </tr>
            <?php
            }
            ?>


        </tbody>
			</table>
			
		</div>
	</div>        
</div>
<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
        <form method="post" action="">
				<div class="modal-header">						
					<h4 class="modal-title">Add Ressource</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nom De Ressource</label>
						<input type="text" name="Nom" class="form-control" required>
					</div>
					
					
									
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add" name="submit"></a>
				</div>
			</form>
		</div>
	</div>
</div>

        



    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>

</body>
</html>