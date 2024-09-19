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
              <h2>Select a Friend to remove</h2>
              <div>
              <?php
                          $lines  = file("gc/$username gc.txt");
                          foreach($lines as $line) {
                            $nms = array($username, $line);
                            sort($nms);
                            $action = "";
                            foreach($nms as $nm) {
                            	$action .= $nm." ";
                            }
                              echo "<form action='deldm.php' method='post'>
                            <div>
                            <input type='submit' value='$line' id='username' name='username' class='channelboxred'required>
                            <input type='hidden' id='stat' name='stat' value='$stat'>
                            <input type='hidden' id='username' name='username' value='$username'>
                            <input type='hidden' id='key' name='key' value='$key'>
                            <input type='hidden' id='enemy' name='enemy' value='$line'>
                              </form>
                            </div>";
                          }
                        ?>
                        </div>
                        <form action='channels.php' method='post' class="friend">
                    <p><button type="submit" class="friend">Go Back</button></p>
                    <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                    <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                    <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                  </form>
            </div>
        </div>
    </section>
</body>
</html>