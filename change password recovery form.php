<?php
if(isset($_GET['token'])){
  $token = $_GET['token'];
  $token = stripslashes(htmlspecialchars($token));
} else {
  $token = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Cavemen Network - Change Password</title>
  <link rel="icon" type="image/png" href="favicon.png">
</head>
<body>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
      $("#exit").click(function () {
      var frm = document.getElementById("form");
      frm.submit();
    });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="module" src="script.js"></script>
    <section>
        <div class="form-box">
            <div class="form-value">
              <form action="change password recovery.php" method="post">
                      <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" id="npassword" name="npassword" required>
                            <label for="">New Password</label>
                        </div>
                      <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" id="cnpassword" name="cnpassword" required>
                            <label for="">Confirm New Password</label>
                        </div>
                      <input type='hidden' id='token' name='token' value='<?php echo $token?>'>
                      <button type="submit" class="button" onclick="lsRememberMe()">Change Password</button>
                      </form>
                    <div class="register">
                        <p>Already have an account? <a href="index.php">Login</a></p>
                    </div>
            </div>
        </div>
    </section>
</body>
</html>
