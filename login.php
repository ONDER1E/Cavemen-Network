<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();
if(isset($_POST["checkbox"])){
  $checkbox = $_POST['checkbox'];
  $checkbox = stripslashes(htmlspecialchars($checkbox));
} else {
  $checkbox = "";
}
if(isset($_POST["login"])){
  $login = $_POST['login'];
} else {
  $login = "";
}
if(isset($_POST["redirect"])){
  $redirect = $_POST['redirect'];
} else {
  $redirect = "";
}
  if ($checkbox == 'checked'){
    $username = strtolower($_POST['username']);
	  $password = strtolower($_POST['password']);
    setcookie("remusername", $username, time() + 34560000, "/"); // 86400 = 1 day
    setcookie("rempassword", $password, time() + 34560000, "/"); // 86400 = 1 day
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
  } else {
    $username = strtolower($_POST['username']);
	  $password = strtolower($_POST['password']);
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
  }

  include('connection.php');
	$username = $_POST['username'];
	$password = $_POST['password'];
   //to prevent from mysqli injection
  $username = strtolower($username);
  $password = strtolower($password);
  $username = stripcslashes($username);  
  $password = stripcslashes($password);  

  if(mysqli_connect_errno()) { 
    $userempass = $_ENV['account_'.$username];
    if($userempass == $password){
      $lstat = "su";
    } else {
      $lstat = "un";
    }
    $_SESSION["stat"] = $lstat;
  } else {
    $username = mysqli_real_escape_string($con, $username);  
    $password = mysqli_real_escape_string($con, $password); 
    $sql = "select *from accounts where username = '$username' and password = '$password'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
    if($count == 1){  
      $lstat = "su";
    } else{  
      $lstat = "un";
    }
    $_SESSION["stat"] = $lstat;
  }
/*
$userempass = $_ENV['account_'.$username];
if($userempass == $password){
  $lstat = "su";
} else {
  $lstat = "un";
}
$_SESSION["stat"] = $lstat;
*/
?>
<!DOCTYPE html>
<html lang="en">
<form action="channels.php" method="post" id="form">
  <input type="hidden" id="stat" name="stat" value="<?php echo $lstat?>">
  <input type="hidden" id="username" name="username" value="<?php echo $username?>">
  <input type="hidden" id="password" name="password" value="<?php echo $password?>">
  <input type='hidden' id='login' name='login' value="<?php echo $login?>">
  <input type='hidden' id='redirect' name='redirect' value="<?php echo $redirect?>">
  <input type="hidden" id="key" name="key" value="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN">
  <script type="text/javascript">
    function formAutoSubmit () {
      var frm = document.getElementById("form");
      frm.submit();
    }

    window.onload = formAutoSubmit;
  </script>
</form>
</html>


