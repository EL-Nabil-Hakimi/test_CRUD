 <?php

include "connect.php";

$id = $_GET["ResourceID"];
$sql = "SELECT ressource1.ResourceID , ressource1.Nom , ressource1.categoryID CategoryID_f  , category.CategoryName  CategoryName
, sub_category.SubCategoryID sub_f , sub_category.SubCategoryName
FROM ressource1
 LEFT JOIN category ON
 ressource1.categoryID = category.categoryID  
 LEFT JOIN  sub_category ON 
 ressource1.subcategoryID = sub_category.SubCategoryID  WHERE ResourceID = $id ; ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if (isset($_POST['Edit'])) {
  $Nom = $_POST['Nom'];
  $CategoryID = $_POST['categoryID'];
  $SubCategoryID = $_POST['subcategoryID']; // Corrected variable name

  if ($CategoryID !== "") {
      $sqlEDIT = "UPDATE `ressource1` SET `Nom`='$Nom', `categoryID`='$CategoryID' WHERE ResourceID=$id";
      $ResultEDIT = mysqli_query($conn, $sqlEDIT);
  } else {
      $sqlEDIT = "UPDATE `ressource1` SET `Nom`='$Nom', `categoryID`= NULL WHERE ResourceID=$id";
      $ResultEDIT = mysqli_query($conn, $sqlEDIT);
  }

  if ($SubCategoryID !== "") { // Corrected variable name
      $sqlEDIT = "UPDATE `ressource1` SET `Nom`='$Nom', `subcategoryID`='$SubCategoryID' WHERE ResourceID=$id";
      $ResultEDIT = mysqli_query($conn, $sqlEDIT);
  } else {
      $sqlEDIT = "UPDATE `ressource1` SET `Nom`='$Nom', `subcategoryID`= NULL WHERE ResourceID=$id";
      $ResultEDIT = mysqli_query($conn, $sqlEDIT);
  }

  if ($ResultEDIT) {
      header("Location: Ressources.php?msg=L'utilisateur a été modifié avec succès");
  } else {
      echo "Failed: " . mysqli_error($conn);
  }
}

$subCategoryQuery = "SELECT categoryID, CategoryName FROM category";
$subCategoryResult = mysqli_query($conn, $subCategoryQuery);

$subCategoryQuery1 = "SELECT subCategoryID, SubCategoryName FROM sub_category";
$subCategoryResult1 = mysqli_query($conn, $subCategoryQuery1);

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
            <a href="SubCategory.php"><span class="fa fa-cogs"></span>SubCategory</a>
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




	<div >
	<div class="modal-dialog">
		<div class="modal-content">
		<form method="post" >
				<div class="modal-header">						
					<h4 class="modal-title">La Modification Du Ressource</h4>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nom</label>
						<input type="text" name="Nom" class="form-control" value = "<?php echo $row['Nom'] ?>" required>
					</div>

          <label for="">Category</label>

          <select name="categoryID" class="form-control">
          <option value="">Sans Category</option>
                <?php
               
                while ($subCategoryRow = mysqli_fetch_assoc($subCategoryResult)) {
                    $selected = ($subCategoryRow['categoryID'] == $row['categoryID']) ? 'selected' : '';
                    echo "<option value='{$subCategoryRow['categoryID']}' $selected>{$subCategoryRow['CategoryName']}</option>";
                }
                ?>
            </select>


            <label for="">SubCategory</label>

          <select name="subcategoryID" class="form-control">

          <option value="">Sans Category</option>
                <?php
               
               while ($subCategoryRow = mysqli_fetch_assoc($subCategoryResult1)) {
                $selected = ($subCategoryRow['subCategoryID'] == $row['sub_f']) ? 'selected' : '';
                echo "<option value='{$subCategoryRow['subCategoryID']}' $selected>{$subCategoryRow['SubCategoryName']}</option>";
            }
                ?>
            </select>   
					
				<div class="modal-footer">
				    <a href = "Ressources.php"><input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel"></a>
					<input type="submit" class="btn btn-info" value="Edit" name="Edit">
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
</html>