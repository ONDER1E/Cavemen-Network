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
if(isset($_POST["login"])){
  $login = $_POST['login'];
  $login = stripslashes(htmlspecialchars($login));
} else {
  $login = "";
}
if(isset($_POST["redirect"])){
  $redirect = $_POST['redirect'];
} else {
  $redirect = "";
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
    if ($redirect == "true"){
      if ($_SESSION["type"] == "DM") {
        $redirecto = $_SESSION["redirecto"];
      } else if ($_SESSION["type"] == "GC") {
        $redirecto = $_SESSION["redirecto"];
      } else {
        $redirecto = $_SESSION["redirecto"];
      }
      $rstat = $_SESSION["stat"];
      $rusername = $_SESSION["username"];
      $rkey = $_SESSION["key"];
      $raction = $_SESSION["urname"];
      $rline = $_SESSION["dmname"];
      $rtype = $_SESSION["type"];

      echo "<form action='$redirecto' method='post' id='form'>
                            <div>
                            <input type='hidden' id='stat' name='stat' value='$rstat'>
                            <input type='hidden' id='username' name='username' value='$rusername'>
                            <input type='hidden' id='key' name='key' value='$rkey'>
                            <input type='hidden' id='urname' name='urname' value='$raction'>
                            <input type='hidden' id='dmname' name='dmname' value='$rline'>
                            <input type='hidden' id='type' name='type' value='$rtype'>
                              </form>
                            </div>
                            <!DOCTYPE html>
                            <html lang='en'>
                              <script type='text/javascript'>
                                function formAutoSubmit () {
                                  var frm = document.getElementById('form');
                                  frm.submit();
                                }
                            
                                window.onload = formAutoSubmit;
                              </script>
                            </form>
                            </html>";
    ?>
    <?php
    } else if($key!="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN"){
      errPageSer();
    } else if($stat!="su"){
      if($login != "true"){
        ?>
        <!DOCTYPE html>
<html lang="en">
  <?php
    echo "<form action='index.php' method='post' id='form'>
      <div>
      <input type='hidden' id='relogin' name='relogin' value='true'>
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
        errPageAuth();
      }
      
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
    <script>
    </script>
    <section>
        <div class="form-box">
            <div class="form-value">
                      <div>
                        <?php
                          $lines4 = file("global.html");
                          $lines5 = file("global.html");
                          end($lines4);
                          $end2 = prev($lines4);
                          if(strpos($end2, $username) !== false){
                              echo "<form action='global.php' method='post'>
                            <input type='submit' value='Global' id='username' name='username' class='channelbox'required>
                            <input type='hidden' id='stat' name='stat' value='$stat'>
                            <input type='hidden' id='username' name='username' value='$username'>
                            <input type='hidden' id='key' name='key' value='$key'>
                            <input type='hidden' id='urname' name='urname' value='global'>
                              </form>";
                              } else if(str_starts_with(end($lines5), "<!---->")){
                            if(!strpos(end($lines5), $username)){
                              echo "<form action='global.php' method='post'>
                            <input type='submit' value='Global' id='username' name='username' class='channelboxgold'required>
                            <input type='hidden' id='stat' name='stat' value='$stat'>
                            <input type='hidden' id='username' name='username' value='$username'>
                            <input type='hidden' id='key' name='key' value='$key'>
                            <input type='hidden' id='urname' name='urname' value='global'>
                              </form>";
                            }
                              } else {
                            echo "<form action='global.php' method='post'>
                            <input type='submit' value='Global' id='username' name='username' class='channelbox'required>
                            <input type='hidden' id='stat' name='stat' value='$stat'>
                            <input type='hidden' id='username' name='username' value='$username'>
                            <input type='hidden' id='key' name='key' value='$key'>
                            <input type='hidden' id='urname' name='urname' value='global'>
                              </form>";
                              }
                          $lines  = file("dms/$username dm.txt");
                          foreach($lines as $line) {
                            $nms = array($username, $line);
                            sort($nms);
                            $action = "";
                            foreach($nms as $nm) {
                            	$action .= $nm." ";
                            }
                            $action = str_replace(array("\r", "\n"), '', $action);
                            $lines6 = file("dms/$action.html");
                            $lines7 = file("dms/$action.html");
                            end($lines6);
                            $end2 = prev($lines6);
                            if(strpos($end2, $username) !== false){
                              echo "<form action='channel sender.php' method='post'>
                            <div>
                            <input type='submit' value='DM $line' id='username' name='username' class='channelbox'required>
                            <input type='hidden' id='stat' name='stat' value='$stat'>
                            <input type='hidden' id='username' name='username' value='$username'>
                            <input type='hidden' id='key' name='key' value='$key'>
                            <input type='hidden' id='urname' name='urname' value='$action'>
                            <input type='hidden' id='dmname' name='dmname' value='$line'>
                            <input type='hidden' id='type' name='type' value='DM'>
                              </form>
                            </div>";
                            } else if(end($lines7)=="<!---->"){
                                echo "<form action='channel sender.php' method='post'>
                            <div>
                            <input type='submit' value='DM $line' id='username' name='username' class='channelboxgold'required>
                            <input type='hidden' id='stat' name='stat' value='$stat'>
                            <input type='hidden' id='username' name='username' value='$username'>
                            <input type='hidden' id='key' name='key' value='$key'>
                            <input type='hidden' id='urname' name='urname' value='$action'>
                            <input type='hidden' id='dmname' name='dmname' value='$line'>
                            <input type='hidden' id='type' name='type' value='DM'>
                              </form>
                            </div>";
                              } else {
                              echo "<form action='channel sender.php' method='post'>
                            <div>
                            <input type='submit' value='DM $line' id='username' name='username' class='channelbox'required>
                            <input type='hidden' id='stat' name='stat' value='$stat'>
                            <input type='hidden' id='username' name='username' value='$username'>
                            <input type='hidden' id='key' name='key' value='$key'>
                            <input type='hidden' id='urname' name='urname' value='$action'>
                            <input type='hidden' id='dmname' name='dmname' value='$line'>
                            <input type='hidden' id='type' name='type' value='DM'>
                              </form>
                            </div>";
                              }
                            }
                          $lines  = file("gc/$username gc.txt");
                          foreach($lines as $line) {
                            $action = $line;
                            $action = str_replace(array("\r", "\n"), '', $action);
                            $lines4 = file("gc/$action gc.html");
                            $lines5 = file("gc/$action gc.html");
                            end($lines4);
                            $result = "";
                            $foile  = file("gc/$action gc.txt");
                            foreach($foile as $loine){
                              $result .= "$loine, ";
                            }
                            $end2 = prev($lines4);
                            if(strpos($end2, $username) !== false){
                              echo "<form action='channel sender.php' method='post'>
                            <div>
                            <input type='submit' value='$line GC' id='username' name='username' class='channelbox'required>
                            <input type='hidden' id='stat' name='stat' value='$stat'>
                            <input type='hidden' id='username' name='username' value='$username'>
                            <input type='hidden' id='key' name='key' value='$key'>
                            <input type='hidden' id='urname' name='urname' value='$line'>
                            <input type='hidden' id='dmname' name='dmname' value='$result'>
                            <input type='hidden' id='type' name='type' value='GC'>
                              </form>
                            </div>";
                            } else if(end($lines5)=="<!---->"){
                                echo "<form action='channel sender.php' method='post'>
                            <div>
                            <input type='submit' value='$line GC' id='username' name='username' class='channelboxgold'required>
                            <input type='hidden' id='stat' name='stat' value='$stat'>
                            <input type='hidden' id='username' name='username' value='$username'>
                            <input type='hidden' id='key' name='key' value='$key'>
                            <input type='hidden' id='urname' name='urname' value='$line'>
                            <input type='hidden' id='dmname' name='dmname' value='$result'>
                            <input type='hidden' id='type' name='type' value='GC'>
                              </form>
                            </div>";
                              } else {
                              echo "<form action='channel sender.php' method='post'>
                            <div>
                            <input type='submit' value='$line GC' id='username' name='username' class='channelbox'required>
                            <input type='hidden' id='stat' name='stat' value='$stat'>
                            <input type='hidden' id='username' name='username' value='$username'>
                            <input type='hidden' id='key' name='key' value='$key'>
                            <input type='hidden' id='urname' name='urname' value='$line'>
                            <input type='hidden' id='dmname' name='dmname' value='$result'>
                            <input type='hidden' id='type' name='type' value='GC'>
                              </form>
                            </div>";
                              }
                            }
                        ?>
                        
                        
                      </div>
                    <div class="register">
                        <form action='settings.php' method='post'>
                          <p><button type="submit" class="friend">settings</button></p>
                          <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                          <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                          <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                        </form>
                        <form action='channels.php' method='post'>
                          <p><button type="submit" class="friend">Refresh</button></p>
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