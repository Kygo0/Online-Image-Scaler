<?php
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'images');

    // Check if the delete request was made
    if(isset($_POST['id'])) {
        // Delete the image from the database
        $id = intval($_POST['id']);
        $query = "DELETE FROM pictures WHERE ID = '$id'";
        mysqli_query($conn, $query);
        echo json_encode(array("status" => true));
    }

    // Close the database connection
    mysqli_close($conn);
?>
