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
if(isset($_POST["friend"])){
  $friend = $_POST['friend'];
  $friend = stripslashes(htmlspecialchars($friend));
} else {
  $friend = "";
}

if($stat=="un"){
  $out = "Incorrect Username or Password";
} else if($key!="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN"){
  $out = "Internal Server Error";
} else{
  $friend = stripcslashes($friend);  
  $friend = mysqli_real_escape_string($con, $friend);  
  $friendandtag = (explode("#", $friend));
  $count = 99;
  if(strpos($friend, "#") !== false){
    $friendandtag[1] = $friendandtag[1] + 1;
    $friendandtag[1] = $friendandtag[1] - 1;
    $sql = "select *from accounts where username = '$friendandtag[0]' and id = '$friendandtag[1]'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result); 
  }

  if($count==99){
    $out = "Invalid username or tag";
  } else if($count != 1){  
    $out = "None has that name";
  } else{  
    $nms = array($username, $friendandtag[0]);
    sort($nms);
    $filename = "";
    foreach($nms as $nm) {
      $filename .= $nm." ";
    }
    if(file_exists("dms/$filename.php")){
      $out = "User already added";
    } else {
      if ( 0 == filesize( "dms/$username dm.txt" ) ){
      file_put_contents("dms/$username dm.txt", "$friendandtag[0]", FILE_APPEND );
      } else {
        file_put_contents("dms/$username dm.txt", "\n$friendandtag[0]", FILE_APPEND );
      }
      if ( 0 == filesize( "dms/$friendandtag[0] dm.txt" ) ){
      file_put_contents("dms/$friendandtag[0] dm.txt", "$username", FILE_APPEND );
      } else {
        file_put_contents("dms/$friendandtag[0] dm.txt", "\n$username", FILE_APPEND );
      }
      fopen("dms/$filename.html", "w");
      $out = "Friend Added";
    }
  }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Cavemen Network - Add Friend</title>
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
