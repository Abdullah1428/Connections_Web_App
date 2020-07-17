<?php
    
    include("database.php");

    $response = array();

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        die("Cannot Connect!! Something went wrong");
    }

    // params in the url post body
    $senderID = $_POST["senderID"];
    $senderEmail = $_POST["senderEmail"];
    $senderName = $_POST["senderName"];
    $senderImage = $_POST["senderImage"];
    $recieverEmail = $_POST["recieverEmail"];
    $message = $_POST["message"];

    $mID = null;
    $nowtime = time();
    $timeStamp = date("Y-m-d H:i:s",$nowtime);

    // server side validation
    if(!filter_var($recieverEmail , FILTER_VALIDATE_EMAIL)) {
        $response["success"] = 0;
        $response["message"] = "Please enter correct email";
        echo json_encode($response);
        exit();
    }

    if (strlen($message) < 5) {
        $response["success"] = 0;
        $response["message"] = "Please enter a proper message";
        echo json_encode($response);
        exit();
    }

    if ($senderEmail == $recieverEmail) {
        $response["success"] = 0;
        $response["message"] = "Error Cannot send message to yourself";
        echo json_encode($response);
        exit();
    }


    $sql_querry = "SELECT * FROM user where userEmail=:recieverEmail";
    $sql_stmnt = $conn->prepare($sql_querry);
    $sql_stmnt->bindParam(':recieverEmail', $recieverEmail, PDO::PARAM_STR);
    $sql_stmnt->execute();
    
    if(!$sql_stmnt->rowCount()) {
        $response["success"] = 0;
        $response["message"] = "No user found!!Enter a valid email";
        echo json_encode($response);
        exit();
    } else {
        foreach ($sql_stmnt as $recieverDetail) {
            $recieverID = $recieverDetail["userID"];
            $recieverName = $recieverDetail["userName"];
            $recieverEmail = $recieverDetail["userEmail"];
            $recieverImage = $recieverDetail["userImage"];
        }
        $insert_sql = "INSERT INTO messages (mID,senderID,recieverID,senderName,recieverName,senderEmail,recieverEmail,message,senderImage,recieverImage,timeStamp) VALUES 
        (:mID,:senderID,:recieverID,:senderName,:recieverName,:senderEmail,:recieverEmail,:message,:senderImage,:recieverImage,:timeStamp)";

        $stmnt = $conn->prepare($insert_sql);
        $stmnt->bindParam(':mID', $mID, PDO::PARAM_STR);
        $stmnt->bindParam(':senderID', $senderID, PDO::PARAM_STR);
        $stmnt->bindParam(':recieverID', $recieverID, PDO::PARAM_STR);
        $stmnt->bindParam(':senderName', $senderName, PDO::PARAM_STR);
        $stmnt->bindParam(':recieverName',$recieverName , PDO::PARAM_STR);
        $stmnt->bindParam(':senderEmail', $senderEmail, PDO::PARAM_STR);
        $stmnt->bindParam(':recieverEmail',$recieverEmail , PDO::PARAM_STR);
        $stmnt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmnt->bindParam(':senderImage', $senderImage, PDO::PARAM_STR);
        $stmnt->bindParam(':recieverImage',$recieverImage , PDO::PARAM_STR);
        $stmnt->bindParam(':timeStamp', $timeStamp, PDO::PARAM_STR);
        $stmnt->execute();

        if($stmnt->rowCount())
		{
			$response["success"] = 1;
			$response["message"] = "Message sent successfully";
            echo json_encode($response);
            exit();	
		} else {
            $response["success"] = 0;
			$response["message"] = "Message sending failed!!Try again";
            echo json_encode($response);
            exit();	
        }
    }


?>