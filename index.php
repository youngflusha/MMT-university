<?php

require_once "config.php";
require_once "session.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
  $fullname = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $password_hash = password_hash($password, PASSWORD_BCRYPT);

  if($query = db -> prepare("SELECT * FROM users WHERE email = ?")){

  $error = '';
  // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
  $query -> bind_param('s', $email);
  $query -> execute();

  //Stores the result so we can check if the account exists in the database

  $query -> store_result();
    if($query-> num_rows > 0) {

      $error .= '<p class="error"> Esse email já está a ser utilizado</p>';
    } else {
      //validate password
      if(strlen($password) < 6) {
        $error .= '<p class="error">A sua senha tem que ter pelo menos 6 caracteres</p>';
      }

      if(empty($error) ) {
        $insertQuery = $db-> prepare("INSERTO INTO users(name, email, password) VALUES (?,?,?)");
        $insertQuery->bind_param("sss", $fullname, $email, $password_hash);
        $result = $insertQuery->execute();

        if($result){
          $error .= '<p class="Success"> O seu registo foi validado</p>';
        } else {
          $error .= '<p class="error"> Algo não correu como suposto.</p>';
        }
      }
    }
  }

  $query-> close();
  $insertQuery->close();

// Close db connection
mysqli_close($db);
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
