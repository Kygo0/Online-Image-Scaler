<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Online Image Editor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style_gallery.css" rel="stylesheet">
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
<h1> THESE ARE YOUR PHOTOS! <h
<div class="gallery">
    <?php
        // Open a connection to the database
        $conn = new mysqli('localhost', 'root', '', 'images');

        // Retrieve the image data from the database
        $query = "SELECT name, data FROM pictures";
        $result = mysqli_query($conn, $query);

        // Loop through the image data and display each image
        while ($row = mysqli_fetch_array($result)) {
            $name = $row['name'];
            $data = $row['data'];
            echo '<div class="img-container">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($data) . '" alt="' . $name . '" width="100%">';
            echo '</div>';
        }

        // Close the database connection
        mysqli_close($conn);
    ?>
</div>
</body>
</html>

