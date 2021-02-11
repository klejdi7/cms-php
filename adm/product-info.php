<?php
session_start();
require 'php/con.php';
require 'php/functions.php';
require '../classes/Products.php';
require '../classes/Brands.php';
require '../classes/User.php';

$prod_id = $_GET['prod_info'];
$product = new Product;
$product->product_info($prod_id);
$sizes = $product->getAllSizes();

$brand = new Brand;
$data = $brand->allBrands();

$user = new User($_SESSION['user_id']);
$user->getUserData();

if(isset($_POST['info_update'])){
  $product->updateProduct($prod_id);
}
user_logged($_SESSION['logged_in']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <base href="http://shopmanager.com/adm/">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Produktet | <?php echo $product->name; ?> </title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Brand Manager</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="/home">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Klientë
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="/orders">
          <i class="fas fa-fw fa-folder"></i>
          <span>Porositë</span>
        </a>

      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Produkte
      </div>
<!-- Produktet -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-book"></i>
          <span>Produktet</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
            <a class="collapse-item" href="/add_product">Shto Produkt</a>
            <a class="collapse-item" href="/products">Produktet</a>
            <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a> -->
            <a class="collapse-item" href="/brands">Brandet</a>
          </div>
        </div>
      </li>
      <!-- -->
      <!-- Artikuj -->

            <!-- -->
      <hr class="sidebar-divider">


      <!-- Heading -->
      <?php if($user->role == "Admin"): ?>
      <div class="sidebar-heading">
        Parametra
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="/users">
<i class="fas fa-users"></i>
          <span>Perdorues</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
    <?php endif ?>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <form class="form-inline">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
          </form>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $user->username?></span>
                <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <h1 class="h3 mb-2 text-gray-800"><?php echo $product->name; ?></h1>

          <div class="row">
          <!-- Page Heading -->
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
<div class="col-md-6">
          <div class="input-group mb-3" style="width:50%;">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">Emertimi</span>
    </div>
    <input type="text" class="form-control" value="<?php echo $product->name; ?>" aria-label="Username" aria-describedby="basic-addon1" readonly>
    </div>

<div class="input-group mb-3" style="width:50%;">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Brand</span>
</div>
<input type="text" class="form-control" value="<?php echo $product->brand; ?>" aria-label="Username" aria-describedby="basic-addon1" readonly>
</div>

<div class="input-group mb-3" style="width:50%;">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Tipi</span>
</div>
<input type="text" class="form-control" value="<?php echo $product->type; ?>" aria-label="Username" aria-describedby="basic-addon1" readonly>
</div>

<div class="input-group mb-3" style="width:50%;">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> Stoku</span>
</div>
<input type="text" class="form-control" value="<?php echo $product->shteti; ?>" aria-label="Username" aria-describedby="basic-addon1" readonly>
</div>

<div class="input-group mb-3" style="width:50%;">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> Çmimi ne Stok </span>
</div>
<input type="text" class="form-control"
<?php if($product->shteti == "Kosove"): settype($product->stock_price, "integer")?>
 value="<?php echo $product->stock_price * 0.0081;?><?php echo $product->currency; ?>"
<?php else: ?>
value="<?php echo $product->stock_price?> <?php echo $product->currency; ?>"
<?php endif ?>
aria-label="Username" aria-describedby="basic-addon1" readonly>
</div>


<div class="input-group mb-3" style="width:50%;">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> Çmimi </span>
</div>
<input type="text" class="form-control"
<?php if($product->shteti == "Kosove"): settype($product->price, "integer")?>
 value="<?php echo $product->price * 0.0081;?><?php echo $product->currency; ?>"
<?php else: ?>
value="<?php echo $product->price?> <?php echo $product->currency; ?>"
<?php endif ?>
aria-label="Username" aria-describedby="basic-addon1" readonly>
</div>



<div class="input-group mb-3" style="width:50%;">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> Krijuar </span>
</div>
<input type="text" class="form-control" value="<?php echo $product->created_at; ?>" aria-label="Username" aria-describedby="basic-addon1" readonly>
</div>
<a class="btn btn-info" style="color:#fff;" id="up_info"> Ndrysho te dhenat </a>
<form class="update_info " id="update_info" style="margin-top:10px;display:none;" method="post">

  <div class="input-group mb-3" style="width:50%;">
  <div class="input-group-prepend">
  <span class="input-group-text" id="basic-addon1"> Emertimi </span>
  </div>
  <input type="text" class="form-control" name="name" value="<?php echo $product->name ?>" aria-label="Username" aria-describedby="basic-addon1" required>
  </div>


  <div class="input-group mb-3" style="width:50%;">
  <div class="input-group-prepend">
  <span class="input-group-text" id="basic-addon1"> Brand </span>
  </div>
  <select id="inputState" name="brand" class="form-control">
    <?php foreach($data as $brand): ?>
      <option value="<?php echo $brand['brand_name'] ?>" ><?php echo $brand['brand_name']; ?></option>
    <?php endforeach ?>
  </select>
</div>

  <div class="input-group mb-3" style="width:50%;">
  <div class="input-group-prepend">
  <span class="input-group-text" id="basic-addon1"> Tipi </span>
  </div>
  <select id="inputState" name="type" class="form-control">
    <option value="Veshje">Veshje</option>
    <option value="Kepuce">Kepuce</option>
  </select>
</div>

  <div class="input-group mb-3" style="width:50%;">
  <div class="input-group-prepend">
  <span class="input-group-text" id="basic-addon1"> Stock </span>
  </div>
  <input type="text" class="form-control" name="stock" value="<?php echo $product->stock; ?>" aria-label="Username" aria-describedby="basic-addon1" required>
  </div>

  <div class="input-group mb-3" style="width:50%;">
  <div class="input-group-prepend">
  <span class="input-group-text" id="basic-addon1"> Çmimi ne Stok </span>
  </div>
  <input type="text" class="form-control" name="stock_price" value="<?php echo $product->stock_price ?>" aria-label="Username" aria-describedby="basic-addon1" required>
  </div>

<div class="input-group mb-3" style="width:50%;">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"> Çmimi </span>
</div>
<input type="text" class="form-control" name="price" value="<?php echo $product->price ?>" aria-label="Username" aria-describedby="basic-addon1" required>
</div>

  <input type="submit" name="info_update" class="btn btn-primary">

</form>
</div>
<!-- Masat -->
<div class="col-md-6">
  <h1 class="mb-2 text-gray-800">Masat</h1>
  <h4 class="mb-2 text-gray-800">Masat -> Stok</h4>

<?php foreach ($sizes as $size): ?>
  <div class="input-group mb-3" style="width:50%;">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"><?php echo $size['masa'] ?></span>
</div>
<input type="text" class="form-control" value="<?php echo $size['stok'] ?>" aria-label="Username" aria-describedby="basic-addon1" readonly>
</div>
<?php endforeach ?>
  </div>
  <!-- MASAT -->
</div>



            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>

      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    <!-- End of Content Wrapper -->

  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="php/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <!-- Costum Javascript -->
  <script src="js/page_functions.js"></script>
</body>

</html>
