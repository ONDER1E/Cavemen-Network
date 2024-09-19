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
if(isset($_POST["dmname"])){
  $dmname = $_POST['dmname'];
  $dmname = stripslashes(htmlspecialchars($dmname));
} else {
  $dmname = "";
}
if(isset($_POST['urname'])){
  $urname = $_POST['urname'];
  $urname = stripslashes(htmlspecialchars($urname));
} else {
  $urname = "";
}
if(isset($_POST["type"])){
  $type = $_POST['type'];
  $type = stripslashes(htmlspecialchars($type));
} else {
  $type = "";
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
                        <form action="index.php" method="post">
                          <p><button type="submit" class="friend">Logout</button></p>
                          <input type="hidden" id="logout" name="logout" value="true">
                        </form>
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

if($stat!="su"){
        ?>
        <!DOCTYPE html>
<html lang="en">
  <?php
    $_SESSION["username"] = $name;
    $_SESSION["stat"] = $stat;
    $_SESSION["key"] = $key;
    $_SESSION["urname"] = $urname;
    $_SESSION["dmname"] = $dmname;
    $_SESSION["type"] = $type;
    $_SESSION["redirecto"] = $_SERVER['PHP_SELF'];
    echo "<form action='index.php' method='post' id='form'>
      <div>
      <input type='hidden' id='relogin' name='relogin' value='true'>
      <input type='hidden' id='redirect' name='redirect' value='true'>
        </form>
      </div>";
?>
  <script type="text/javascript">
    function formAutoSubmit () {
      var frm = document.getElementById("form");
      frm.submit();
    }

    window.onload = formAutoSubmit;
  </script>
</form>
</html>
        <?php
} else if($key!="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN"){
  errPageSer();
} else {
  if ($type == "DM"){
    $lines  = file("dms/$username dm.txt");
    $result = 0;
    foreach($lines as $line) {
      $nms = array($username, $line);
      sort($nms);
      $action = "";
      foreach($nms as $nm) {
        $action .= $nm." ";
      }
      $action = str_replace(array("\r", "\n"), '', $action);
      if ($action == $urname) {
        $result += 1;
      }
    }
    if ($result == 1) {
      $_SESSION["urname"] = $urname;
      ?>
<!DOCTYPE html>
<html lang="en">
  <?php
    echo "<form action='dms/chat.php' method='post' id='form'>
      <div>
      <input type='hidden' id='stat' name='stat' value='$stat'>
      <input type='hidden' id='username' name='username' value='$username'>
      <input type='hidden' id='key' name='key' value='$key'>
      <input type='hidden' id='dmname' name='dmname' value='$dmname'>
      <input type='hidden' id='type' name='type' value='DM'>
        </form>
      </div>";
?>
  <script type="text/javascript">
    function formAutoSubmit () {
      var frm = document.getElementById("form");
      frm.submit();
    }

    window.onload = formAutoSubmit;
  </script>
</form>
</html>
<?php
    } else {
      errPageSer();
    }
  } else if ($type == "GC") {
    $lines  = file("gc/$username gc.txt");
    $result = 0;
    foreach($lines as $line) {
      $action = $line;
      $action = str_replace(array("\r", "\n"), '', $action);
      if ($action == $urname) {
        $result += 1;
      }
    }
    if ($result == 1) {
      $_SESSION["urname"] = "$urname gc";
      ?>
<!DOCTYPE html>
<html lang="en">
  <?php
    echo "<form action='gc/chat.php' method='post' id='form'>
      <div>
      <input type='hidden' id='stat' name='stat' value='$stat'>
      <input type='hidden' id='username' name='username' value='$username'>
      <input type='hidden' id='key' name='key' value='$key'>
      <input type='hidden' id='dmname' name='dmname' value='$dmname'>
      <input type='hidden' id='type' name='type' value='GC'>
        </form>
      </div>";
?>
  <script type="text/javascript">
    function formAutoSubmit () {
      var frm = document.getElementById("form");
      frm.submit();
    }

    window.onload = formAutoSubmit;
  </script>
</form>
</html>
<?php
    } else {
      errPageSer();
    }
  }
}
?>