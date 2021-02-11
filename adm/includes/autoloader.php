<?php

spl_autoload_register('AutoLoader');

function AutoLoader($className){
$path = "../classes/";
$extension = ".php";
$fullPath = $path . $className .$extension;

include_once $fullPath;
}
?>
