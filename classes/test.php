<?php

include_once 'User.php';
// require 'UserRegLog.php';

$reg_user = new UserSet("1000", "Klejdi","fefef", "Jke", "sfasaf");

$tokenUser = new Tokening("");
$tokenUser->userToken();
// $reg_user->userToken();


$user = new User("1000", "Klejdi","fefef", "Jke", "sfasaf");
$user->checkToken();
