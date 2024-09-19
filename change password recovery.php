<?php
include('connection.php');
if(isset($_POST['token'])){
  $token = $_POST['token'];
  $token = stripslashes(htmlspecialchars($token));
} else {
  $token = "";
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

require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if($token==""){
  $out = "No token provided.";
} else{
  function replitdb_get($key) {
  	$replitdb_url = $_ENV["REPLIT_DB_URL"];
  	return file_get_contents("$replitdb_url/$key");
  }
  if (!str_starts_with($token, $_ENV['RECOVERY_SALT'])) {
    $out = "Invalid token provided.";
    return;
  }
  $email = replitdb_get($token);
  $sql = "select *from accounts where email = '$email'";  
  $result = mysqli_query($con, $sql);  
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
  $count = mysqli_num_rows($result);  
    
  if($count == 1){  
    $result = "su";
  } else {
    $result = "un";
  }
  
  if($result=="su"){
    if($npassword==$cnpassword){
      mysqli_query($con, "UPDATE accounts SET password = '$npassword' WHERE email = '$email'");
      function replitdb_delete($key) {
      	$opts = array('http' =>
      	    array(
      	        'method'  => 'DELETE'
      	    )
      	);
      	$replitdb_url = $_ENV["REPLIT_DB_URL"];
      	return file_get_contents("$replitdb_url/$key", false, stream_context_create($opts));
      }
      replitdb_delete($token);
      $out = "Password Successfully Changed";
      $link = "index.php";
    } else {
      $out = "New passwords do not match";
      $link = "change%20password%20recovery%20form.php?token=".$token;
    }
  } else {
    $out = "Invalid token provided.";
    $link = "index.php";
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
                        <form action="<?php echo $link?>" method="post" id="form">
                    <input type="hidden" id="stat" name="stat" value="<?php echo $stat?>">
                    <input type="hidden" id="username" name="username" value="<?php echo $username?>">
                    <input type="hidden" id="key" name="key" value="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN">
                    <p>Undo? <button type="submit" class="back">Go Back</button></p>
                    </form>
                    </div>
                    <div class="register">
                        <p>Already have an account? <a href="index.php">Login</a></p>
                    </div>
            </div>
        </div>
    </section>
</body>
</html>
}