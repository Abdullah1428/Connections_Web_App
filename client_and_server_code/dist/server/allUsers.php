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

    $userEmail = $_POST['userEmail'];

    $sql_query = "SELECT * FROM user where userEmail != :userEmail";
    $sql_stmnt= $conn->prepare($sql_query);
	$sql_stmnt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
    $sql_stmnt->execute();

    if($sql_stmnt->rowCount()) {
        $response["allUsers"] = array();

        foreach ($sql_stmnt as $All_Users) {
            $Users = array();
            $Users["user_name"] = $All_Users["userName"];
            $Users["user_email"] = $All_Users["userEmail"];
            $Users["user_image"] = $All_Users["userImage"];
            array_push($response["allUsers"],$Users);
        }

        $response["success"] = 1;
        $response["message"] = "successfully fetched all users";
        echo json_encode($response);
        exit();
    } else {
        $response["success"] = 0;
        $response["message"] = "no user found";
        echo json_encode($response);
        exit();
    }

?>