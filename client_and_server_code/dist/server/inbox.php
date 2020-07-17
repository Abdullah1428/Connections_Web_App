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

    $userID = $_POST["userID"];

    $sql = "SELECT senderName,senderEmail,message,senderImage,timeStamp FROM messages where recieverID=:userID";
    $stmnt = $conn->prepare($sql);
    $stmnt->bindParam(':userID', $userID, PDO::PARAM_STR);
    $stmnt->execute();

    if($stmnt->rowCount()) {

        $response["userInfo"] = array();
        foreach($stmnt as $inboxUser) {
            $info = array();
            $info["inName"] = $inboxUser["senderName"];
            $info["inEmail"] = $inboxUser["senderEmail"];
            $info["message"] = $inboxUser["message"];
            $info["inImage"] = $inboxUser["senderImage"];
            $info["inTime"] = $inboxUser["timeStamp"];
            array_push($response["userInfo"],$info);
        }

        $response["success"] = 1;
        $response["message"] = "users fetched successfully";
        echo json_encode($response);
    } 
    else 
    {
        $response["success"] = 0;
        $response["message"] = "No messages recieved";
        echo json_encode($response);
    }

?>