<?php
session_start();
 require '../classes/User.php';
 require '../classes/UserRegLog.php';
$user = New User($_SESSION['user_id']);
$user->getUserData();

  if($_SESSION['logged_in'] == false){
  header("location: /");
}
if($user->role != "Admin"){
header("location: /");
}

    if (isset($_POST['register']) && $_POST['name'] != "" && $_POST['password'] != "")
    {
      $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
      $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
      $userset = new UserSet($username,$pass);
      $userset->createUser();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Brand Manager | Regjistro Perdorues</title>

  <!-- Custom fonts for this template-->
  <link href="adm/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="adm/css/sb-admin-2.min.css" rel="stylesheet">

</head>

    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Regjistro Perdorues</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                          <div class="form-group">
                                              <label class="small mb-1" for="inputEmailAddress">Emri</label>
                                              <input class="form-control py-4" id="inputEmailAddress" type="text" name="name" placeholder="Emri Perdoruesit" />
                                          </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Username</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" name="username" placeholder="Username i perdoruesit" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Password per perdoruesin" />
                                            </div>
                                            <div class="form-group">
                                              <label class="small mb-1" for="selectRole">Roli per perdoruesin</label>
                                                <select class="form-control" name="role" id="selectRole">
                                                  <option value="Admin">Admin</option>
                                                  <option value="Default">I Thjeshte</option>
                                                </select>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit" name="register">Regjistro</a>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div> -->
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="adm/vendor/jquery/jquery.min.js"></script>
        <script src="adm/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="adm/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="adm/js/sb-admin-2.min.js"></script>

    </body>
</html>
