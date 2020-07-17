<?php
    $response = array();
    if (isset($_FILES['file'])) {
        $target_Dir = "images/";
        $userImage = basename($_FILES['file']['name']);
        $target_Path = $target_Dir . $userImage;
        $imageType = pathinfo($target_Path,PATHINFO_EXTENSION);

        // saving user profile image in server in a folder named images
        if(!empty($_FILES["file"]["name"])){
            $allowTypes = array('jpg','png','jpeg');
            if(in_array($imageType, $allowTypes)) {
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_Path)){
                    $response["success"] = 1;
                    $response["uploadMessage"] = "Image upload successful";
                    echo json_encode($response);
                    exit(); 
                } else {
                    $response["success"] = 0;
                    $response["uploadMessage"] = "error in uploading";
                    echo json_encode($response);
                    exit(); 
                }
            } else {
                $response["success"] = 0;
                $response["uploadMessage"] = "Not supported type for the image";
                echo json_encode($response);
                exit();
            } 
        } else {
            $response["success"] = 0;
            $response["uploadMessage"] = "No image file found";
            echo json_encode($response);
            exit();
        }
    }
?>