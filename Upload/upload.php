

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Online Image Editor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style_upload.css" />
</head>
<header>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="upload.php">Online Image Editor</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="/imageseditor/Home/home.php">Homepage</a>
                        <a class="nav-link" href="/imageseditor/Upload/upload.php">Upload</a>
                        <a class="nav-link" href="/imageseditor/Gallery/gallery.php">Gallery</a>
                        <br>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</header>

<br>
<br>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image">
        <br>
        <br>
        <br>
        <input type="submit" value="Upload Image">
    </form>
    <div id="message"></div>
</body>
</html>



<script src="script_upload.js"></script>

<?php
    if(!isset($_FILES['image'])) {
        die("No image selected");
    }

    if(is_null($_FILES['image'])) {
        die("No image selected");
    }

    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die("An error occurred while uploading the file.");
    }
    
    // Get the file data
    $image = $_FILES['image'];
    $image_name = $image['name'];

    // Validate the file type
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
        die('Invalid file type');
    }
    
    // Move the file to the desired location
    move_uploaded_file($image['tmp_name'], 'path/to/upload/'.$image_name);

    // Store the image in the database
    // Open a connection to the database
    $conn = new mysqli('localhost', 'root', '', 'images');

    // Prepare the image data for insertion
    $data = file_get_contents($image['tmp_name']);
    $data = mysqli_real_escape_string($conn, $data);

    // Insert the image data into the database
    $query = "INSERT INTO pictures (name, data) VALUES ('$image_name', '$data')";
    $result = mysqli_query($conn, $query);

    // Check for errors
    if (!$result) {
        die('Error uploading image: ' . mysqli_error($conn));
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect the user to a new page
    header('Location: upload.php');
    exit;
?>
