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
if(isset($_POST["name"])){
  $name = $_POST['name'];
  $name = stripslashes(htmlspecialchars($name));
} else {
  $name = "";
}
if(isset($_POST["GCname"])){
  $gcname = $_POST['GCname'];
  $gcname = stripslashes(htmlspecialchars($gcname));
} else {
  $gcname = "";
}
if(isset($_POST["pass"])){
  $pass = $_POST['pass'];
  $pass = stripslashes(htmlspecialchars($pass));
} else {
  $pass = "";
}

function array_prep_for_transport($package){
  array_unique($package);
  $result = "";
  foreach($package as $pack){
    $result .= $pack." ";
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
function errPageGCexists(){
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
                    <h2>GC Name already used</h2>
                    <div class="register">
                      <form action='add gc.php' method='post'>
                        <input type='submit' id='friend' name='friend' class="friend" value='Go Back'>
                        <input type='hidden' id='stat' name='stat' value="<?php echo $stat?>">
                        <input type='hidden' id='username' name='username' value="<?php echo $username?>">
                        <input type='hidden' id='key' name='key' value="<?php echo $key?>">
                      </form>
                    </div>
            </div>
        </div>
    </section>
</body>
<?php
}
function nameMe(){
  if(isset($_POST["GCname"])){
    $gcname = $_POST['GCname'];
  } else {
    $gcname = "";
  }
?>
  <!DOCTYPE html>
  <html lang="en"> 
  <form method='post'>
                <div class="inputbox">
                          <ion-icon name="mail-outline"></ion-icon>
                          <input type="text" id="GCname" name="GCname" required value="<?php echo $gcname?>">
                          <label for="">GC Name</label>
                      </div>
<?php
}
function mainPage(){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Cavemen Network - Make a GC</title>
  <link rel="icon" type="image/png" href="favicon.png">
</head>
<body>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="module" src="script.js"></script>
    <section>
        <div class="form-box">
            <div class="form-value">
                      <h2>Users</h2>
                      <div>
                        <?php
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
                          if(isset($_POST["name"])){
                            $name = $_POST['name'];
                            $name = stripslashes(htmlspecialchars($name));
                          } else {
                            $name = "";
                          }
                          if(isset($_POST["rname"])){
                            $rname = $_POST['rname'];
                            $rname = stripslashes(htmlspecialchars($rname));
                          } else {
                            $rname = "";
                          }
                          if(isset($_POST["GCname"])){
                            $gcname = $_POST['GCname'];
                            $gcname = stripslashes(htmlspecialchars($gcname));
                          } else {
                            $gcname = "";
                          }
                          if(isset($_POST["pass"])){
                            $pass = $_POST['pass'];
                          } else {
                            $pass = "";
                          }
                          if($pass != "true"){
                            $names = array("$username");
                          } else {
                            if(isset($_POST["names"])){
                              $names = $_POST['names'];
                              $names = explode(" ", $names);
                              $names = array_unique($names);
                              $index = array_search($rname,$names);
                              if($index !== FALSE){
                                  unset($names[$index]);
                              }
                              $names = array_unique($names);
                            } else {
                              $names = "";
                            }
                          }
                          nameMe();
                        ?>
                      </div>
                          <p><button type="submit" formaction="add gc add users.php" class="friend">Add someone</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                          <input type='hidden' id='names' name='names' value='<?php echo array_prep_for_transport($names)?>'>
                        <p><button type="submit" formaction="add gc remove users.php" class="friend">Remove someone</button></p>
                    </form>
                        <form action='creategc.php' method='post'>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                          <input type='hidden' id='filename' name='filename' value='<?php echo $gcname?>'>
                          <input type='hidden' id='names' name='names' value='<?php echo array_prep_for_transport($names)?>'>
                          <input name="friends" class="button"type="submit" id="friends" value="Create GC" />
                        </form>
                        <form action='settings.php' method='post'>
                          <p><button type="submit" class="friend">Back</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                        </form>
                        <?php
  $names = array_unique($names);
                  foreach($names as $nam){
                            echo "<div>
                            <input type='text' value='$nam' id='name' name='name' class='channelbox'required>
                            </div>";
                          }
                ?>
                    </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php
}
?>
<?php
    if($key!="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN"){
      errPageSer();
    }
    if($stat=="un"){
      errPageAuth();
    } else if($pass != 'true') {
      if(file_exists("gc/$gcname gc.txt")){
         errPageGCexists();
      } else {
        mainPage();
    }
} else {
      mainpage();
}