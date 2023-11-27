<?php
include "connect.php";

$query = "SELECT COUNT(*) as userCount FROM user";
$result = mysqli_query($conn, $query);

$query1 = "SELECT COUNT(*) as ctgrCount FROM category";
$result1 = mysqli_query($conn, $query1);

$query2 = "SELECT COUNT(*) as SubctgrCount FROM sub_category";
$result2 = mysqli_query($conn, $query2);

$query3 = "SELECT COUNT(*) as rsrc FROM ressource1";
$result3 = mysqli_query($conn, $query3);

if ($result && $result1 && $result2) {
    $row = mysqli_fetch_assoc($result);
    $userCount = $row['userCount'];

    $row1 = mysqli_fetch_assoc($result1);
    $userCount1 = $row1['ctgrCount'];

    $row2 = mysqli_fetch_assoc($result2);
    $userCount2 = $row2['SubctgrCount'];
    $row3 = mysqli_fetch_assoc($result3);
    $userCount3 = $row3['rsrc'];

} else {
    $echec = "Vide";
}

mysqli_close($conn);
?>



<!doctype html>
<html lang="en">
  <head>
  	<title>Sidebar 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="images/logo.avif" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
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




        <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <h2 class="mb-5 text-white">Stats Card</h2>
        <div class="header-body">
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Utilisateur</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $userCount ?></span>
                    </div>
                
                  </div>
                 
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Catégories</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $userCount1 ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">SubCatégories</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $userCount2 ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">ressources</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $userCount3 ?></span>
                    </div>
                    <div class="col-auto">
                      
                    </div>
                  </div>
         
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


            
      </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>