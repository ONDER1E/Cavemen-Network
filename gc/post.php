<?php
date_default_timezone_set('Europe/London');
  function trim_lines($path, $max) {
    // Read the lines into an array
    $lines = file($path);
    $lines2 = file('file.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    // Setup counter for loop
    $counter = 0;
    while($counter < $max) {
      // array_pop removes the last element from an array
      array_pop($lines);
      // Increment the counter
      if(!str_ends_with($lines2[sizeof($lines2)], "<!---->")){
        $counter++;
      }
    }  // End loop
    // Write the trimmed lines to the file
    file_put_contents($path, implode('', $lines));
  }
  $name = $_POST['usern'];
  $text = $_POST['text'];
  $file = $_POST['file'];

  if(str_starts_with($text, 'sudo')){
    if($name=="umair"){
      if($text=="sudo cls") {
        file_put_contents("$file.html", "");
      } else if($text=="") {
        $fail = "fail";
      } else if(str_starts_with($text, 'sudo del')) {
        $spliText = (explode(" ", $text));
        $max = (int)$spliText[2];
        trim_lines("$file.html", $max);
      }
    }
  } else if($name == "") {
    $fail = "fail";
  } else if($text == "") {
    $fail = "fail";
  } else {
    $lines = file("$file.html");
    if(strpos(end($lines), "<!---->") !== false){
      $end2 = prev($lines);
    } else {
      end($lines);
      $end2 = end($lines);
    }
    if(strpos($end2, date("d/m/y")) !== false){
        $e = "e";
    } else {
      $text_message = "\n<div class='".date("d/m/y")."'></div><div class='msgln'><span class='chat-time'>‎ ‎ <u>".date("l d M, y - ").date("d/m/y")."</u><br></div>";
      file_put_contents("$file.html", $text_message, FILE_APPEND | LOCK_EX);
    }
    if(str_starts_with($text, 'http') || (str_starts_with($text, '/') && str_ends_with($text, ".png"))){
      $imagext = array('.jpg', '.png', '.gif', '.webp', '.tiff', '.psd', '.raw', '.bmp', '.heif', '.indd', '.jpeg', '.svg', '.ai', '.eps');
      $result = "";
      foreach($imagext as $ext){
        if (strpos(strtolower(stripslashes(htmlspecialchars($text))), $ext)){
          $text_message = "\n<div class='".date("d/m/y")."'></div><div class='msgln'><span class='chat-time'>".date("‎ ‎ g:i A")."</span> <b class='user-name'>".$name."</b> <br>"."<img src='".stripslashes(htmlspecialchars($text)). "' alt=".stripslashes(htmlspecialchars($text))." style='max-width:450px;width:75%' >"."<br></div>";
        file_put_contents("$file.html", $text_message, FILE_APPEND | LOCK_EX);
        file_put_contents("$file.html", "\n<!---->", FILE_APPEND | LOCK_EX);
          $result .= "e";
        }
      }
        
      if ($result == "") {
        $text_message = "\n<div class='".date("d/m/y")."'></div><div class='msgln'><span class='chat-time'>".date("‎ ‎ g:i A")."</span> <b class='user-name'>".$name."</b> <br>"."<a href='".stripslashes(htmlspecialchars($text))."' target='_blank' style='max-width:600px;width:100%'>".stripslashes(htmlspecialchars($text))."</a>"."<br></div>";
      file_put_contents("$file.html", $text_message, FILE_APPEND | LOCK_EX);
      file_put_contents("$file.html", "\n<!---->", FILE_APPEND | LOCK_EX);
      }
    } else {
      $text_message = "\n<div class='".date("d/m/y")."'></div><div class='msgln'><span class='chat-time'>".date("‎ ‎ g:i A")."</span> <b class='user-name'>".$name."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
      file_put_contents("$file.html", $text_message, FILE_APPEND | LOCK_EX);
      file_put_contents("$file.html", "\n<!---->", FILE_APPEND | LOCK_EX);
    }
  }
?>
