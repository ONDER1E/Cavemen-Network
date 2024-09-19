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
  <title>Cavemen Network - Channels</title>
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
                      </div>
                    <div class="register">
                        <form action='add dm.php' method='post'>
                          <p><button type="submit" class="friend">Add a friend</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                        </form>
                        <form action='remove dm.php' method='post'>
                          <p><button type="submit" class="friend">Remove a friend</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                        </form>
                        <form action='add gc.php' method='post'>
                          <p><button type="submit" class="friend">Make a GC</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                        </form>
                        <form action='remove gc.php' method='post'>
                          <p><button type="submit" class="friend">Delete a GC</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                        </form>
                        <form action='join a gc.php' method='post'>
                          <p><button type="submit" class="friend">Join a gc</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                        </form>
                        <form action='leave gc.php' method='post'>
                          <p><button type="submit" class="friend">Leave a GC</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                        </form>
                        <form action='change password form.php' method='post'>
                          <p><button type="submit" class="friend">Change password</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                        </form>
                        <form action='change email form.php' method='post'>
                          <p><button type="submit" class="friend">Change Email</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                        </form>
                        <form action='channels.php' method='post'>
                          <p><button type="submit" class="friend">Go back</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                        </form>
                      <form action='index.php' method='post'>
                          <p><button type="submit" class="friend">Logout</button></p>
                          <input type='hidden' id='logout' name='logout' value='true'>
                        </form>
                    </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php
}
?>