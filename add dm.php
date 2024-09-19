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
$username = stripcslashes($username);    
$username = mysqli_real_escape_string($con, $username);   
$sql = "SELECT id FROM accounts WHERE username = '$username'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $user_id = $row["id"];
  }
} else {
  echo "0 results";
}
$user_id = str_pad($user_id, 4, '0', STR_PAD_LEFT);
$tag = $username;
$tag .= "#";
$tag .= $user_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Cavemen Network - Add friend</title>
  <link rel="icon" type="image/png" href="favicon.png">
</head>
<body>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="module" src="script.js"></script>
    <section>
        <div class="form-box">
            <div class="form-value">
              <span>Your name and tag is: <?php echo $tag?></span>
                      <div >
                        <form action='createdm.php' method='post'>
                <div class="inputbox">
                          <ion-icon name="mail-outline"></ion-icon>
                          <input type="text" id="friend" name="friend"required>
                          <label for="">Name & Tag</label>
                      </div>
                <input type='hidden' id='stat' name='stat' value='<?php echo $stat?>'>
                <input type='hidden' id='username' name='username' value='<?php echo $username?>'>
                <input type='hidden' id='key' name='key' value='<?php echo $key?>'>
                <input name="friends" class="button"type="submit" id="friends" value="Add Friend" />
            </form>
                      </div>
                    <form action='channels.php' method='post'>
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