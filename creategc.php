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
if(isset($_POST["filename"])){
  $filename = $_POST['filename'];
  $filename = stripslashes(htmlspecialchars($filename));
} else {
  $filename = "";
}
if(isset($_POST["names"])){
  $names = $_POST['names'];
  $names = stripslashes(htmlspecialchars($names));
  $names = explode(" ", $names);
} else {
  $names = "";
}
function errPageAuth(){
    echo 
    '<head>
  <link rel="stylesheet" href="style.css">
  <title>Cavemen Network - Error</title>
  <link rel="icon" type="image/png" href="favicon.png">
</head>
<body>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="module" src="script.js"></script>
    <section>
        <div class="form-box">
            <div class="form-value">
                    <h2>Incorrect Username or Password</h2>
                    <div class="register">
                        <p>Undo? <a href="index.php">Go Back</a></p>
                    </div>
            </div>
        </div>
    </section>
</body>';
}
function errPageSer(){
    echo 
    '<head>
  <link rel="stylesheet" href="style.css">
  <title>Cavemen Network - Error</title>
  <link rel="icon" type="image/png" href="favicon.png">
</head>
<body>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="module" src="script.js"></script>
    <section>
        <div class="form-box">
            <div class="form-value">
                    <h2>Internal Server Error</h2>
                    <div class="register">
                        <p>Undo? <a href="index.php">Go Back</a></p>
                    </div>
            </div>
        </div>
    </section>
</body>';
}
if($key!="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN"){
  errPageSer();
}
if($stat=="un"){
  errPageAuth();
} else if (count($names) >= 3){
  fopen("gc/$filename gc.txt", "w");
  fopen("gc/$filename gc.html", "w");
  foreach($names as $nam){
    if ( 0 == filesize( "gc/$nam gc.txt" ) ){
      file_put_contents("gc/$nam gc.txt", "$filename", FILE_APPEND );
    } else {
      file_put_contents("gc/$nam gc.txt", "\n$filename", FILE_APPEND );
    }
    if ( 0 == filesize( "gc/$filename gc.txt" ) ){
      file_put_contents("gc/$filename gc.txt", "$nam", FILE_APPEND );
    } else {
      file_put_contents("gc/$filename gc.txt", "\n$nam", FILE_APPEND );
    }
  }
  if(file_exists("gc/$username owned gc.txt")){
    file_put_contents("gc/$username owned gc.txt", "\n$filename", FILE_APPEND );
  } else {
    fopen("gc/$username owned gc.html", "w");
    file_put_contents("gc/$username owned gc.txt", "$filename", FILE_APPEND );
  }
  $out = "GC Created";
} else {
  $out = "Not enough users invited to the GC";
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
