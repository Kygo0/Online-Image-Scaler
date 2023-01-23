 <?php

// Check if the form has been submitted
if (isset($_FILES['image'])) {
  // Get the uploaded file information
  $file = $_FILES['image'];

  // File properties
  $file_name = $file['name'];
  $file_tmp = $file['tmp_name'];
  $file_size = $file['size'];
  $file_error = $file['error'];

  // Work out the file extension
  $file_ext = explode('.', $file_name);
  $file_ext = strtolower(end($file_ext));

  $allowed = array('jpg', 'jpeg', 'png');

  if (in_array($file_ext, $allowed)) {
    if ($file_error === 0) {
      if ($file_size <= 2097152) {
        $file_name_new = uniqid('', true) . '.' . $file_ext;
        $file_destination = 'uploads/' . $file_name_new;

        if (move_uploaded_file($file_tmp, $file_destination)) {
          // Connect to the database
          $conn = mysqli_connect('localhost', 'root', '', 'images');

          // Insert the file path into the database
          $sql = "INSERT INTO images.pictures (image_url) VALUES ('$file_destination')";

          if (mysqli_query($conn, $sql)) {
              // Success message
              echo "Image has been uploaded successfully";
          } else {
              // Error message
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }

          // Close the connection
          mysqli_close($conn);
        }
      }
    }
  }
}
?>
 <!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Image Editor</title>
    
    <link href="homeStyle.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <!-- Cropper CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
    <!-- Cropper JS -->
    <link rel="stylesheet" href="homeStyle.css" />

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php">Online Image Editor</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="home.php">Homepage</a>
                        <a class="nav-link" href="/imageseditor/Upload/upload.php">Upload</a>
                        <a class="nav-link" href="/imageseditor/Gallery/gallery.php">Gallery</a>
                        <br>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <h1>
        <!-- <div class="resizer">
             <div class="drop-zone">
                 <span class="drop-zone__prompt">Drop file here or click to upload</span>
                 <input type="file" name="myFile" class="drop-zone__input resizer__file">
             </div>
             <div class="dimensions">
                 <input type="text" class="resizer__input resizer__input--width" value="0">
                 x
                 <input type="text" class="resizer__input resizer__input--height" value="0">
                 <label>
                     <input type="checkbox" class="resizer__aspect" checked>
                     Keep Aspect Ratio
                 </label>
             </div>
             <canvas class="resizer__canvas" width="500" height="500"></canvas>
         </div>-->
    </h1>
    <main class="page">
        <h2>Upload ,Crop and save.</h2><br>
        <!-- input file -->
        <!-- <div class="box">
        <input type="file" id="file-input">
    </div>-->
        <div class="resizer">
            <div class="drop-zone box">
                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                <input type="file" name="myFile" id="file-input" class="drop-zone__input resizer__file resizer__input resizer__input--width resizer__input--height">
            </div>
            <canvas class="resizer__canvas" width="500" height="500" hidden></canvas>
            <!--<div class="dimensions">
            <input type="text" class="resizer__input resizer__input--width" value="0">
            x
            <input type="text" class="resizer__input resizer__input--height" value="0">
            <label>
                <input type="checkbox" class="resizer__aspect" checked>
                Keep Aspect Ratio
            </label>
        </div>-->
        </div>
        <!-- leftbox -->
        <div class="box-2">
            <div class="result"></div>
        </div>
        <!--rightbox-->
        <div class="box-2 img-result hide">
            <!-- result of crop -->
            <img class="cropped" src="" alt="">
        </div>
        <!-- input file -->

        <div class="box">
            <div class="options hide">
                <label> Size </label>
                <input type="number" class="img-w" value="300" min="100" max="1200" />
            </div>
        </div>
        <!-- save btn --> 
        <button class="btn save hide">Save</button>
        <!-- 
        <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="Upload">
        </form>
            -->
       
        
        <a href="" class="btn download hide">Download</a>

    </main>
    
    <script src="homeScript.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js'></script>
</body>
</html>