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
  $lines  = file("gc/$enemy gc.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach($lines as $line) {
      $lines2  = file("gc/$line gc.txt");
      $search = "$enemy";
      
      $result = '';
      foreach($lines2 as $line2) {
          if(stripos($line2, $search) === false) {
              $result .= $line2;
          }
      }
      file_put_contents("gc/$line gc.txt", $result);
    }
  $result = '';
  $lines3  = file("gc/$username owned gc.txt");
  $search = "$enemy";
  foreach($lines3 as $line3) {
      if(stripos($line3, $search) === false) {
          $result .= $line;
      }
  }
  file_put_contents("gc/$username owned gc.txt", $result);
  unlink("gc/$enemy gc.txt");
  unlink("gc/$enemy gc.html");
  $out = "GC Deleted";
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
