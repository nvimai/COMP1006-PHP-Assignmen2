<?php
try {
    //process photo if there is one
    $photo = $_FILES['photo']['name'];

    if (!empty($photo)) {
        //get and check the type
        $type = $_FILES['photo']['type'];
        
        if (($type == "image/jpeg") || ($type == "image/png")) {
            //valid image, so save the file
            //session_start();
            
            //create a unique name
            $photo = 'images/' . session_id() . "-" . $photo;
            
            //save the image
            $tmp_name = $_FILES['photo']['tmp_name'];
            move_uploaded_file($tmp_name, "$photo");
        }
    }
    else {
        //user did not upload a new photo.  set current photo equal to the old photo
        $photo = $_POST['image'];
    }
} catch (Exception $e) {
    //redirect to the error page
    header('location: error.php');
}
?>