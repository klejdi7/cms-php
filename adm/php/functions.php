<?php
function redirect_to($to){
      return header("location: $to");
}

function echo_limited($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}

function user_logged($user){
      if($user == false)
       header("location: /");
}
?>
