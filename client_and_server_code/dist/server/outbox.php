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

    $sql = "SELECT recieverName,recieverEmail,message,recieverImage,timeStamp FROM messages where senderID=:userID";
    $stmnt = $conn->prepare($sql);
    $stmnt->bindParam(':userID', $userID, PDO::PARAM_STR);
    $stmnt->execute();

    if($stmnt->rowCount()) {

        $response["userInfo"] = array();
        foreach($stmnt as $outboxUsers) {
            $info = array();
            $info["outName"] = $outboxUsers["recieverName"];
            $info["outEmail"] = $outboxUsers["recieverEmail"];
            $info["message"] = $outboxUsers["message"];
            $info["image"] = $outboxUsers["recieverImage"];
            $info["outTime"] = $outboxUsers["timeStamp"];
            array_push($response["userInfo"],$info);
        }

        $response["success"] = 1;
        $response["message"] = "users fetched successfully";
        echo json_encode($response);
    } 
    else 
    {
        $response["success"] = 0;
        $response["message"] = "No messages sent";
        echo json_encode($response);
    }

?>