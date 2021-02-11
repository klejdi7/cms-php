<?php
session_start();
require 'php/con.php';
require 'php/functions.php';
require '../classes/Order.php';

if(!isset($_SESSION['prods'])){
  unset($_SESSION['prods']);
$_SESSION['prods'] = array();
}
$order = new Order();

if(isset($_POST['add_clothes'])){
$order->AddToList($_GET['shteti']);
}
if(isset($_POST['add_shoes'])){
$order->AddToList($_GET['shteti']);
}

if(isset($_POST['create'])){
$order->create_order();
}
$currency = "€";
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

  <title>Krijo Porosi</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#order" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-sort-amount-up-alt"></i>
          <span>Porosite</span>
        </a>
        <div id="order" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
            <a class="collapse-item" href="/new_order">Krijo Porosi</a>
            <a class="collapse-item" href="/orders">Porosite</a>
            <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a> -->
            <!-- <a class="collapse-item" href="/brands">Brandet</a> -->
          </div>
        </div>
      </li>
      <!-- Nav Item - Utilities Collapse Menu -->

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
      <?php //if($_SESSION['role'] == "Admin"): ?>
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
    <?php //endif ?>

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
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
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
          <?php include("php/errors.php"); ?>

          <!-- Page Heading -->
          <select name="state" style="margin-bottom:15px;" id="state"class="form-control" >
            <option disabled selected value> -- Zgjidh Shtetin -- </option>
            <option value="1">Shqiperi</option>
            <option value="2">Kosove</option>
          </select>

          <h1 class="h3 mb-4 text-gray-800">Krijo Porosi</h1>

         </div>
        <!-- /.container-fluid -->

        <table class="table">
      <thead class="thead-dark">
      <tr>
      <th scope="col">ID Produkti</th>
      <th scope="col">Emertimi</th>
      <th scope="col">Brand</th>
      <th scope="col">Masa</th>
      <th scope="col">Sasia</th>
      <th scope="col">Cmimi</th>
      <th scope="col">Total</th>

          </tr>
      </thead>
            <tbody>
              <?php $all_total = 0;foreach($_SESSION['prods'] as $product): ?>

                  <tr>
      <th scope="row"><?php echo $product[0] ?></th>
      <td><?php echo $product[1] ?></td>
      <td><?php echo $product[2] ?></td>
      <td><?php echo $product[3] ?></td>
      <td><?php echo $product[4] ?></td>
      <td><?php echo $product[5] ?></td>
      <td><?php echo $product[6];$all_total += $product[6]; echo  $product[7]; ?>
</td>
    <!-- <td><a href="ffff.tht">gg</a> </td> -->
    </tr>
      </tr>
<?php endforeach ?>
      </tbody>

      </table>
<form method="post" style="margin:20px;">
  <h3 style="font-weight: bold; color:#000;text-align:right;"> TOTALI: <?php echo $all_total, $currency ?></h3>

  <h5 style="font-weight: bold; color:#000;"> Shto Produkt </h5>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity">Veshje</label>
            <select  name="product" class="form-control" id="products">
              <?php
              if(isset($_GET['shteti'])):
              $data = $order->getAllProductsClothes();
              foreach($data as $products):
                ?>
              <option value="<?php echo $products['product_id'] ?>"><?php echo $products['name'] ?></option>
            <?php endforeach;else: ?>
              <option disabled selected value> -- Zgjidh Shtetin Me Larte-- </option>
            <?php endif ?>
            </select>
          </div>

            <div class="form-group col-md-4">
              <label for="inputCity">Masa</label>
              <select  name="size" class="form-control" id="inputPassword4">
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="2XL">2XL</option>
                <option value="3XL">3XL</option>
                <option value="4XL">4XL</option>

              </select>
               </div>
            <div class="form-group col-md-4">
              <label for="inputCity">Sasia</label>
              <input type="number"  class="form-control" name="quantity" id="inputCity">
            </div>
            <?php if(!isset($_GET['shteti'])): ?>
              <input type="submit" name="add" value="Shto" disabled class="btn btn-primary"/>
            <?php else:?>
              <input type="submit" name="add_clothes" value="Shto" class="btn btn-primary"/>
              <?php endif ?>
          </div>
        </form>
        <form method="post" style="margin:20px;">

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity">Kepuce</label>
            <select  name="product" class="form-control" id="products">
              <?php
              if(isset($_GET['shteti'])):
              $sh = $order->getAllProductsShoes();
              foreach($sh as $products):
                ?>
              <option value="<?php echo $products['product_id'] ?>"><?php echo $products['name'] ?></option>
            <?php endforeach;else: ?>
              <option disabled selected value> -- Zgjidh Shtetin Me Larte-- </option>
            <?php endif ?>
            </select>
          </div>
            <div class="form-group col-md-4">
              <label for="inputCity">Masa</label>
              <select  name="size" class="form-control" id="inputPassword4">
                <option value="36">36</option>
                <option value="37">37</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
                <option value="43">43</option>
                <option value="44">44</option>
                <option value="45">45</option>
              </select>
               </div>
            <div class="form-group col-md-4">
              <label for="inputCity">Sasia</label>
              <input type="number"  class="form-control" name="quantity" id="inputCity">
            </div>
          <?php if(!isset($_GET['shteti'])): ?>
            <input type="submit" name="add" value="Shto" disabled class="btn btn-primary"/>
          <?php else:?>
            <input type="submit" name="add_shoes" value="Shto" class="btn btn-primary"/>
            <?php endif ?>

          </div>
        </form>
        <form method="post" style="margin:20px;">
          <h5 style="font-weight: bold; color:#000;"> Klienti </h5>

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputEmail4">Emri</label>
              <input type="text" name="fname" class="form-control" id="inputEmail4" placeholder="Emri" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Mbiemri</label>
              <input type="text" name="lname" class="form-control" id="inputEmail4" placeholder="Mbiemri" required>
            </div>
          </div>
          <input type="hidden" name="total" value="<?php echo $all_total ?>">

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Numer Telefoni</label>
              <input type="text" name="cel" class="form-control" id="inputEmail4" placeholder="Nr Cel" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputCity">Qyteti</label>
              <input type="text" class="form-control" name="city" id="inputCity" required>
            </div>
            <div class="form-group col-md-4">
              <label for="inputCity">Adresa</label>
              <input type="text" class="form-control" name="adress" id="inputCity">
            </div>

          </div>

          <input type="submit" name="create" value="Shto" class="btn btn-primary">
        </form>
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

    </div>
    <!-- End of Content Wrapper -->

  </div>
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
  <script type="text/javaScript">
    $( "#hide-alert" ).click(function() {
      $("#pop-up").css("display", "none");
    });

    $('#state').on('change', function(){
      window.location.replace("/new_order?shteti="+this.value);
});

// $('#products').on('change', function(){
//   window.location.replace("&shteti="+this.value);
// });
// $('#products').on('change', function(){
//   // window.location.replace("&shteti="+this.value);
//   var product = this.value;
//   $.ajax({
//   url: "View_ajax.php",
//   type: "POST",
//   cache: false,
//   success: function(data){
//     alert(data);
//     $('#table').html(data);
//   }
// });
// });
    </script>

</body>

</html>
