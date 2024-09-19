<?php
session_start();
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
if(isset($_POST["enemy"])){
  $enemy = $_POST['enemy'];
  $enemy = stripslashes(htmlspecialchars($enemy));
} else {
  $enemy = "";
}

if($stat=="un"){
  $out = "Incorrect Username or Password";
} else if($key!="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN"){
  $out = "Internal Server Error";
} else{
  $myfile = fopen("dms/$username dm.txt", "r") or die("Unable to open file!");
  $file = fread($myfile,filesize("dms/$username dm.txt"));
  if(strpos($file, $enemy) !== false){
    $lines  = file("dms/$username dm.txt");
    
    $result = '';
    foreach($lines as $line) {
        if(stripos($line, $enemy) === false) {
            $result .= $line;
        }
    }
    file_put_contents("dms/$username dm.txt", $result);
  } else {
    $out = "Internal server Error";
  }
  fclose($myfile);
  $myfile = fopen("dms/$enemy dm.txt", "r") or die("Unable to open file!");
  $file = fread($myfile,filesize("dms/$enemy dm.txt"));
  if(strpos($file, $username) !== false){
    $lines2  = file("dms/$enemy dm.txt");
    
    $result = '';
    foreach($lines2 as $line) {
        if(stripos($line, $username) === false) {
            $result .= $line;
        }
    }
    file_put_contents("dms/$enemy dm.txt", $result);
    $out = "Friend Removed";
  } else {
    $out = "Internal server Error";
  }
  fclose($myfile);
  $nms = array($username, $enemy);
  sort($nms);
  $filename = "";
  foreach($nms as $nm) {
    $filename .= $nm." ";
  }
  if (file_exists("dms/$filename.html")) {
    unlink("dms/$filename.html");
  }
  if (file_exists("dms/$filename.php")) {
    unlink("dms/$filename.php");
  }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Cavemen Network - Remove Friend</title>
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
