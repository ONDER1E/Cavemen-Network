<?php
session_start();
if(isset($_SESSION['username'])) {
  $name = $_SESSION['username'];
} else {
  $name = "";
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
if(isset($_SESSION['urname'])){
  $urname = $_SESSION['urname'];
} else {
  $urname = "";
}
if(isset($_POST["dmname"])){
  $dmname = $_POST['dmname'];
  $dmname = stripslashes(htmlspecialchars($dmname));
} else {
  $dmname = "";
}
if(isset($_POST["type"])){
  $type = $_POST['type'];
  $type = stripslashes(htmlspecialchars($type));
} else {
  $type = "";
}
$lines = file("$urname.html");
$lines3 = file("$urname.html");
end($lines);
$end2 = prev($lines);
if(strpos($end2, $name) !== false){
    $e = "e";
    } else {
  if(end($lines3)=="<!---->"){
      $lines2 = file("$urname.html");
      array_pop($lines2);
      file_put_contents("$urname.html", implode('', $lines2));
    }
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
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type="text/javascript">
          // jQuery Document 
          $(document).ready(function () {
              $("#submitmsg").click(function () {
                  var clientmsg = $("#usermsg").val();
                  var user = $("#user").val();
                  var file = $("#file").val();
                  $.post("post.php", { text: clientmsg, usern: user, file: file });
                  $("#usermsg").val("");
                  return false;
              });
              function loadLog() {
                  let cb = "";
                  let cbnew = "";
                  delete cb;
                  delete cbnew;
                  var urnm = "<?php echo $urname; ?>";
                  var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request 
                  $.ajax({
                      url: urnm + '.html',
                      cache: false,
                      success: function (html) {
      let cb = document.getElementById('chatbox').innerHTML.replace(/"/g, '\'').split(/\r?\n/);
      let cbnew = html.replace(/"/g, '\'').split(/\r?\n/);
                          if(cb.length != cbnew.length) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div 
                          }
                          //Auto-scroll 
                          var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request 
                          if(newscrollHeight > oldscrollHeight){
                              $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div 
                          }	
                      }
                  });
              }
              function bottom() {
                  var urnm = "<?php echo $urname; ?>";
                  var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request 
                  $.ajax({
                      url: urnm + '.html',
                      cache: false,
                      success: function (html) {
                          if($("#chatbox").html() != html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div 
                          }
                          //Auto-scroll 
                          var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request 
                          $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div 
                      }
                  });
              }
              function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
              }
              setInterval (loadLog, 1000);
              setInterval (topFunction, 1);
              bottom();
              $("#exit").click(function () {
                  var frm = document.getElementById("form");
                  frm.submit();
              });
      $("#submitmsg").click(function(){

          var fd = new FormData();

          var files = $('#fileup')[0].files;

          // Check file selected or not
          if(files.length > 0 ){

               fd.append('fileup',files[0]);

               $.ajax({
                    url:'upload.php',
                    type:'post',
                    data:fd,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success:function(response){
                         if(response.status == 1){
                              var extension = response.extension;
                              var path = response.path;
                              var user = $("#user").val();
                              var file = $("#file").val();
                              var clientmsg = "/gc/" + path
                              $.post("post.php", { text: clientmsg, usern: user, file: file });
                              $("#usermsg").val("");
                              $("#fileup").val("");
                              

                         }else{
                              alert('File not uploaded');
                         }
                    }
               });
          }
          });
          });
      </script>
      <section>
        <meta charset="utf-8" />
        <title>Cavemen Network - Chat</title>
        <meta name="description" content="Cavemen Network - Chat" />
        <link rel="stylesheet" href="chatStyle.css" />
        <script type="module" src="script.js"></script>
    </head>
    <body>
      <style>
      input.fileup {
  	position: relative;
  	text-align: right;
  	-moz-opacity:0;
  	filter:alpha;
  	opacity: 0;
  	z-index: 2;
  }
    </style>
        <div id="wrapper" class="wrapper">
            <div id="menu" class="menu">
                <p class="welcome">Welcome to <?php echo $dmname ?>'s <?php echo $type ?>, <b><?php echo $name ?></b></p>
                <form action="/channels.php" method="post" id="form">
                  <input type="hidden" id="stat" name="stat" value="<?php echo $stat?>">
                  <input type="hidden" id="username" name="username" value="<?php echo $name?>">
                  <input type="hidden" id="key" name="key" value="sd3xlAq3Wq0tcsYrzDEN2uqgpuAbpVtN">
                <p class="logout"><a id="exit">Exit Chat</a></p>
                  </form>
            </div>
            <div id="chatbox" class="chat-box">
            <?php
            if(file_exists("$urname.html") && filesize("$urname.html") > 0){
                $contents = file_get_contents("$urname.html");          
                echo $contents;
            }
            ?>
            </div>
              <div id="sendbox" class="send-box">
            <form name="message" action="" id="sendboxform">
                <input name="usermsg" type="text" id="usermsg" autocomplete="off" autofocus/>
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
                <input name="user" type="hidden" id="user" value="<?php echo $name?>"/>
                <input name="file" type="hidden" id="file" value="<?php echo $urname?>"/>
                <input type="file" id="fileup" name="fileup" class="fileup" />
            </form>
              </div>
          </section>
        </div>
      <script type="text/javascript">
          //e.originalEvent.clipboardData.files
          const form = document.getElementById("sendboxform");
          const fileInput = document.getElementById("fileup");
          
          fileInput.addEventListener('change', () => {
            form.submit();
          });
          
          window.addEventListener('paste', e => {
            fileInput.files = e.clipboardData.files;
          }); 
           </script>
    </body>
</html>
<?php
}
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
?>