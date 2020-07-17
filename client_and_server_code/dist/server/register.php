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

    $userID = null;
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];
    $userImage = $_POST['userImage'];

    // sever side validation of user name , email , password
    if (!preg_match("/^[a-zA-Z ]*$/",$userName)) {
        $response["success"] = 0;
        $response["message"] = "Please enter a correct name";
        echo json_encode($response);
        exit();
    }

    if(strlen($userPassword) < 6) {
        $response["success"] = 0;
        $response["message"] = "Password too short!! (6 chars atleast)";
        echo json_encode($response);
        exit();
    }

    if(!filter_var($userEmail , FILTER_VALIDATE_EMAIL)) {
        $response["success"] = 0;
        $response["message"] = "Please enter correct email format";
        echo json_encode($response);
        exit();
    }

    // preparing the sql statement
    
    $check_user_sql = 'SELECT * FROM user where userEmail=:userEmail';
    $check_stmnt= $conn->prepare($check_user_sql);
	$check_stmnt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
    $check_stmnt->execute();
    
    // checking if the user already exists or not
    if(!$check_stmnt->rowCount()) {
        $insert_sql = 'INSERT INTO user (userID,userName,userEmail,userPassword,userImage) VALUES (:userID,:userName,:userEmail,
        :userPassword,:userImage)';

        $insert_stmnt = $conn->prepare($insert_sql);
        $insert_stmnt->bindParam(':userID', $userID, PDO::PARAM_STR);
        $insert_stmnt->bindParam(':userName', $userName, PDO::PARAM_STR);
        $insert_stmnt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
        $insert_stmnt->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);
        $insert_stmnt->bindParam(':userImage', $userImage, PDO::PARAM_STR);
        $insert_stmnt->execute();
		if($insert_stmnt->rowCount())
		{
			$response["success"] = 1;
			$response["message"] = "Registered successfully";
            echo json_encode($response);
            exit();	
		} else {
            $response["success"] = 0;
			$response["message"] = "Registration Failed!!Try again";
            echo json_encode($response);
            exit();	
        }
    } else {
        $response["success"] = 0;
		$response["message"] = "User already exists!!";
        echo json_encode($response);
        exit();
    }
?>
