<?php
if(isset($_POST["logout"])){
  $logout_post = $_POST['logout'];
  $logout_post = stripslashes(htmlspecialchars($logout_post));
  if($logout_post == "true"){
    setcookie("remusername", "", time() - 3600);
    setcookie("rempassword", "", time() - 3600);
  	header("Location: index.php");
  }
}
if(isset($_COOKIE['remusername'])) {
  $username = $_COOKIE['remusername'];
} else {
  $username = "";
}
if(isset($_COOKIE['rempassword'])) {
  $password = $_COOKIE['rempassword'];
} else {
  $password = "";
}
if(isset($_POST["stat"])){
  $stat = $_POST['stat'];
} else {
  $stat = "";
}
if(isset($_POST["relogin"])){
  $relogin = $_POST['relogin'];
} else {
  $relogin = "";
}
if(isset($_POST["redirect"])){
  $redirect = $_POST['redirect'];
} else {
  $redirect = "";
}
if ($relogin != "true"){
  $login = "true";
} else {
  $login = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Cavemen Network - Login</title>
  <link rel="icon" type="image/png" href="favicon.png">
</head>
<body>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="module" src="indexScript.js"></script>
    <script>
    var username = '<?php echo $username ;?>';
    var password = '<?php echo $password ;?>';
    if(username != ''){
      if(password != ''){
        function formAutoSubmit () {
          document.getElementById("password").type = "password";
          var frm = document.getElementById("formName");
          frm.submit();
        }
    
        window.onload = formAutoSubmit;
      }
    }
    function makeItPassword()
      {
         document.getElementById("password").type = "password";
         document.getElementById("password").focus();
      }
    
    </script>
    <section>
        <div class="form-box">
            <div class="form-value">
                    <h2>Login</h2>
                    <form action="login.php" method="post" id="formName">
                      <div class="inputbox">
                          <ion-icon name="mail-outline"></ion-icon>
                          <input type="text" id="username" name="username" value="<?php echo $username?>" autocomplete="off"required>
                          <label for="">Name</label>
                      </div>
                      <div class="inputbox">
                          <ion-icon name="lock-closed-outline"></ion-icon>
                          <input type="text" onfocus="return makeItPassword()" id="password" name="password" value="<?php echo $password?>" required>
                          <label for="">Password</label>
                      </div>
                      <div class="forgot">
                          <label for=""><input type="checkbox" name="checkbox" id="rememberMe" value="checked">Remember Me </label>
                          <a href="forgot.html">Forgot Password?</a>
                      </div>
                      <input type='hidden' id='login' name='login' value="<?php echo $login?>">
                      <input type='hidden' id='redirect' name='redirect' value="<?php echo $redirect?>">
                      <button type="submit" class="button" onclick="lsRememberMe()">Login</button>
                      </form>
                    <div class="register">
                        <p>Don't have a account? <a href="registration.html">Register</a></p>
                    </div>
            </div>
        </div>
    </section>
</body>
</html>