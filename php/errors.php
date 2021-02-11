
<?php  if(isset($errors)) : ?>
  <?php foreach ($errors as $error) : ?>
<div class="alert alert-danger" id="pop-up" role="alert">
     <?php echo $error; ?> <h7 id="hide-alert" class="float-right" style="cursor: pointer;color:#ff3300;"> Zhduk </h7>
   </div>
 <?php endforeach ?>

 <?php  endif ?>
