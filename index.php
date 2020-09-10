<?php

session_start();

if(isset($_SESSION['username'])) {
  $_SESSION['msg'] = 'Tem de introduzir as suas crendenciais para ver essa página.';
  header("location: login.hmtl");
}


if(isset($_GET['logout'])){
  session_destroy();
  unset($_SESSION['username']);
  header("location: login.html");
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
</head>

<body>

  <h1>This is the homepage</h1>
  <? php
  if(isset($_SESSION['Success'])) : ?>


  <div>
    <h3>

      <?php
      echo $_SESSION['Success'];
      unset($_SESSION['Success'])
      ?>
    </h3>

  </div>
<?php endif ?>


// if the user logs in print information

<?php if(isset($_SESSION['username'])) : ?>

  <h3> Welcome<strong> <?php echo $_SESSION['username']; ?></strong> </h3>

  <button><a href="index.php?logout='1'"></a></button>
<?php endif ?>
</div>
</body>
