<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
      
      $expensions= array("jpeg","jpg","png","pdf","docx","doc","gif","mp4","avi","3gp","mpeg","mov");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="Select a file or choose a valid file.";
      }
      
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"images/".$file_name);
         header("location: display.php");
      }else{
         print_r($errors);
      }
   }
?>