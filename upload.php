<?php
if(isset($_FILES['fileup']['name'])){

      /* Getting file name */
      $filename = $_FILES['fileup']['name'];

      /* Location */
      $location = "upload/".$filename;

      /* Extension */
      $extension = pathinfo($location,PATHINFO_EXTENSION);
      $extension = strtolower($extension);

      /* Allowed file extensions */
      $allowed_extensions = array("jpg","jpeg","png","pdf","docx");

      $response = array();
      $status = 0;

      /* Check file extension */
      if(in_array(strtolower($extension), $allowed_extensions)) {

           /* Upload file */
          $encfilename = bin2hex(random_bytes(32)).".".$extension;
          $enclocation = "upload/".$encfilename;
          function genenclocation() {
            $encfilename = bin2hex(random_bytes(32)).".".$extension;
            $enclocation = "upload/".$encfilename;
            if(file_exists($enclocation)){
              genenclocation();
            }
          }
          if(file_exists($enclocation)){
            genenclocation();
          }
           if(move_uploaded_file($_FILES['fileup']['tmp_name'],$enclocation)){
             
                 $status = 1; 
                 $response['path'] = $enclocation;
                 $response['extension'] = $extension;

           }
      }

      $response['status'] = $status;

      echo json_encode($response);
      exit;
}

echo 0;
?>