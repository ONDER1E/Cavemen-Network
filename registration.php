<?php

  include('connection.php');
	$username = $_POST['username'];
	$password = $_POST['password'];
  $username = strtolower($username);
  $password = strtolower($password);
  $cpassword = $_POST['cpassword'];
	$idv = $_POST['idv'];
  $username = stripcslashes($username);    
  $username = mysqli_real_escape_string($con, $username);  
  $sql = "SELECT id FROM accounts WHERE username = '$username'";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    $usernameused = "true";
  } else {
    $usernameused = "false";
  }

  $db_host = $_ENV['host'];
  $db_user = $_ENV['user'];
  $db_password = $_ENV['password'];
  $db_name = $_ENV['db_name'];
	// Database connection
	$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
  $myfile = fopen("ids.txt", "r") or die("Unable to open file!");
  $file = fread($myfile,filesize("ids.txt"));
  if($password != $cpassword){
    if(strpos($file, $idv) !== false){
      $lines  = file('ids.txt');
      $search = $idv;
      $result = '';
      foreach($lines as $line) {
          if(stripos($line, $search) === false) {
              $result .= $line;
          }
      }
      file_put_contents('ids.txt', $result);
      if($conn->connect_error){
      		echo "$conn->connect_error";
      		die("Connection Failed : ". $conn->connect_error);
    	} else if ($usernameused == "true") {
        $reg = "Username already in use";
        $lin = "registration.html";
      } else {
          if(isset($_POST["email"])){
            $email = $_POST['email'];
            $email = stripslashes(htmlspecialchars($email));
          } else {
            $email = "";
          }
          $username = stripcslashes($username);  
          $password = stripcslashes($password);  
          $idv = stripcslashes($idv);  
          $email = stripcslashes($email);  
          $username = mysqli_real_escape_string($con, $username);  
          $password = mysqli_real_escape_string($con, $password);
          $idv = mysqli_real_escape_string($con, $idv);
          $email = mysqli_real_escape_string($con, $email);
      		$stmt = $conn->prepare("insert into accounts(username, password, idv, email) values(?, ?, ?, ?)");
      		$stmt->bind_param("ssis", $username, $password, $idv, $email);
      		$stmt->execute();
      		$stmt->close();
      		$conn->close();
          fopen("dms/$username dm.txt", "w");
          fopen("gc/$username gc.txt", "w");
          $reg = "Registration Successful";
          $lin = "index.php";
      }
    } else {
      $reg = "Incorrect or Invalid ID";
      $lin = "registration.html";
    }
  } else {
    $reg = "Passwords do not match";
    $lin = "registration.html";
  }
  fclose($myfile);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Cavemen Network - Registration</title>
  <link rel="icon" type="image/png" href="favicon.png">
</head>
<body>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="module" src="script.js"></script>
    <section>
        <div class="form-box">
            <div class="form-value">
                    <h2><?php echo $reg?></h2>
                    <div class="register">
                        <p>Undo? <a href="<?php echo $lin?>">Go Back</a></p>
                    </div>
            </div>
        </div>
    </section>
</body>
</html>
