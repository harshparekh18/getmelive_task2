<!doctype HTML>
<html>
<head>


   <style type="text/css">
      body{
         background-color:brown;
         text-align: center;
      }

      div{
         border: 1px solid black;
         padding: 4px;
         margin-right: 20%;
         margin-left: 20%;

      }
      .container{
         margin-top: 20px;
      }
      #submit{
         color: blue;font-size: 25px;
      }
      #upload{
         color:grey;font-size: 20px;
      }
      a{
         color: lightblue;
         font-size: 20px;
      }
   </style>
</head>
   <body>
      <div class="container">
      <h1>Upload Images,Videos and PDFs</h1>
   </div>
      <div >
      <form action = "upload.php" method = "POST" enctype = "multipart/form-data"><br>
         <input type = "file" id="upload" name = "image" /><br><br><br>
         <input type = "submit" id="submit" name="submit" /><br><br>
         
      </form>
      </div>
      
         <h1>OR</h1>
   <div>         <h1>Display Existing Files</h1>
         <a href="display.php">Display Files</a>
      </div>
   </body>
</html>