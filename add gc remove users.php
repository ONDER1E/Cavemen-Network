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
  if(isset($_POST["GCname"])){
    $gcname = $_POST['GCname'];
    $gcname = stripslashes(htmlspecialchars($gcname));
  } else {
    $gcname = "";
  }
  if(isset($_POST["names"])){
    $names = $_POST['names'];
    $names = stripslashes(htmlspecialchars($names));
    $names = explode(" ", $names);
  } else {
    $names = "";
  }

function array_prep_for_transport($package, $line){
  $result = "";
  foreach($package as $pack){
    if ($line != $pack){
      $result .= $pack." ";
    }
  }
  $result = rtrim($result, " ");
  $result = str_replace(array("\r", "\n"), '', $result);
  return $result;
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
function lists($line, $stat, $username, $key, $action, $gcname, $names){
  #unset($names[array_search($line,$names)]);
  $namesr = array();
  $line = str_replace(' ', '', $line);
  foreach ($names as $nm){
    $nm = str_replace(' ', '', $nm);
    if ($nm != $line){
      array_push($namesr, $nm);
    }
  }
  $preped = array_prep_for_transport($namesr, $line);
  echo "<form action='add gc.php' method='post'>
        <div>
        <input type='submit' value='$line' id='rname' name='rname' class='channelbox'required>
        <input type='hidden' id='stat' name='stat' value='$stat'>
        <input type='hidden' id='username' name='username' value='$username'>
        <input type='hidden' id='key' name='key' value='$key'>
        <input type='hidden' id='urname' name='urname' value='$action'>
        <input type='hidden' id='pass' name='pass' value='true'>
        <input type='hidden' id='GCname' name='GCname' value='$gcname'>
        <input type='hidden' id='names' name='names' value='$preped'>
          </form>
        </div>";
}
?>
<?php
    if($key!="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN"){
      errPageSer();
    }
    if($stat=="un"){
      errPageAuth();
    } else {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Cavemen Network - Remove a user</title>
  <link rel="icon" type="image/png" href="favicon.png">
</head>
<body>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="module" src="script.js"></script>
    <section>
        <div class="form-box">
            <div class="form-value">
                      <div>
                        <?php
                          $lines  = file("dms/$username dm.txt");
                          foreach($lines as $line) {
                            $nms = array($username, $line);
                            sort($nms);
                            $action = "";
                            foreach($nms as $nm) {
                            	$action .= $nm." ";
                            }
                              lists($line, $stat, $username, $key, $action, $gcname, $names);
                            }
                        ?>
                        
                        
                      </div>
                    <div class="register">
                        <form action='add gc.php' method='post'>
                          <p><button type="submit" class="friend">back</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                          <input type='hidden' id='GCname' name='GCname' value='$gcname'>
                        </form>
                      <p> <a href="index.php">Logout</a></p>
                    </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php
}
?>