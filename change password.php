<?php
session_start();
include('connection.php');
if(isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  $username = "";
}
if(isset($_SESSION['stat'])){
  $stat = $_SESSION['stat'];
} else {
  $stat = "";
}
if(isset($_POST["key"])){
  $key = $_POST['key'];
  $key = stripslashes(htmlspecialchars($key));
} else {
  $key = "";
}
if(isset($_POST["password"])){
  $password = $_POST['password'];
  $password = stripslashes(htmlspecialchars($password));
} else {
  $password = "";
}
if(isset($_POST["npassword"])){
  $npassword = $_POST['npassword'];
  $npassword = stripslashes(htmlspecialchars($npassword));
} else {
  $npassword = "";
}
if(isset($_POST["cnpassword"])){
  $cnpassword = $_POST['cnpassword'];
  $cnpassword = stripslashes(htmlspecialchars($cnpassword));
} else {
  $cnpassword = "";
}

if($stat=="un"){
  $out = "Incorrect Username or Password";
} else if($key!="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN"){
  $out = "Internal Server Error";
} else{
  $username = stripcslashes($username); 
  $username = mysqli_real_escape_string($con, $username);  
  $sql="SELECT password from accounts where username='$username'";
  $res=mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($res);
  $rpassword = $row['password'];
  if($rpassword==$password){
    if($npassword==$cnpassword){
      mysqli_query($con, "UPDATE accounts SET password = '$npassword' WHERE username = '$username'");
      $out = "Password Successfully Changed";
    } else {
      $out = "New passwords do not match";
    }
  } else {
    $out = "Wrong old password";
  }
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
                    <h2><?php echo $out?></h2>
                    <div class="register">
                        <form action="channels.php" method="post" id="form">
                    <input type="hidden" id="stat" name="stat" value="<?php echo $stat?>">
                    <input type="hidden" id="username" name="username" value="<?php echo $username?>">
                    <input type="hidden" id="key" name="key" value="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN">
                    <p>Undo? <button type="submit" class="back">Go Back</button></p>
                    </form>
                    </div>
            </div>
        </div>
    </section>
</body>
</html>
