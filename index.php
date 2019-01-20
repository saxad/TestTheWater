<?php
session_start();

//$_SESSION["isonline"] = false ;
if(isset($_SESSION["isonline"]) && $_SESSION["isonline"] == true){
  header("location:./log.php");
  exit;
}

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST" ){

  if(empty(trim($_POST["email"]))){
    $username_err = " rentrez votre email ";

  }
  else {
    $username = trim($_POST["email"]) ;
  }
  if(empty(trim($_POST["Password"]))){
    $password_err = " rentrez votre Password ";
  }
  else {
    $password = trim($_POST["Password"]) ;
  }

  if(empty($username_err) && empty($password_err) ) {
    require "bdd.php";

    $sql = 'select * FROM users WHERE email = :email AND password = :password';

    $stmt = $pdo->prepare($sql);


    //$stmt->bindValue(':email', $username, PDO::PARAM_STR);
    //$stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute( array(':email' => $username , ':password'=> $password  ));
    $loged = $stmt->fetchAll();
    var_dump($loged[0]["email"]);
    if(sizeof($loged) != 1){
        echo "une erreur est survenue lors de l'execution de la requete";
    }
    else{
      session_start();
      $_SESSION["isonline"] = true ;
      $_SESSION["id"] = $loged[0]["id"];
      $_SESSION["username"] = $username;
      header("location: ./log.php");

    }
    //var_dump($loged);
  }


}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>test page</title>
  </head>
  <body>


<form class="" action="index.php" method="post">

  <div class="imgdiv">
    <img src="id.png" alt="idpic">
  </div>

  <div class="container">
    <span class="err" ><?php echo $username_err; ?></span>
    <br> <label for="email">Email</label>
    <input type="text" name="email" value="<?php echo $username; ?>" placeholder="Email" >

    <label for="Password">Password</label>
    <input type="password" name="Password" value=""placeholder="Password">

    <button type="submit" name="button">Envoyer</button>

    <label >
      <input type="checkbox" name="remember" value="">
      remember me
    </label>

  </div>

  <div class="container">
    <button type="button" name="button" class="csl">Cancel</button>
    <span class="pwd">Frogot<a href="#">Password</a> </span>

  </div>

</form>

  </body>
</html>
