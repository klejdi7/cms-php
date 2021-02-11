<?php
    require "classes/UserRegLog.php";
    //Retrieve the field values from our login form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['pass']) ? trim($_POST['pass']) : null;
    // $cstrong = TRUE;
    // $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
    // $tokenHash = password_hash($token, PASSWORD_BCRYPT, array("cost" => 12));
    $errors = array();
    global $errors;

          $userN = new UserSet($username, $passwordAttempt);
          $userN->loginUser();

            // $user_id = $user['user_id'];
            // $tokenInsert = "INSERT INTO login_tokens (token, user_id)" . "VALUES ('$tokenHash', '$user_id')";
            // $stoken = $pdo->prepare($tokenInsert);

            //Redirect to our protected page, which we called home.php
            if (isset($_POST['rememberme']))
            {
                setcookie('username', $username, time()+60*60*24*365);
            }
            else
            {
                setcookie('username', $_POST['username'], false);
            }

?>
