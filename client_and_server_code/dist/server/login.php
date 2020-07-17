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
    $userPassword = $_POST['userPassword'];

    if(!filter_var($userEmail , FILTER_VALIDATE_EMAIL)) {
        $response["success"] = 0;
        $response["message"] = "Please enter correct email format";
        echo json_encode($response);
        exit();
    }
    
    $check_user_sql = 'SELECT * FROM user where userEmail=:userEmail';
    $check_stmnt= $conn->prepare($check_user_sql);
	$check_stmnt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
    $check_stmnt->execute();
    
    // checking if the user already exists or not
    if($check_stmnt->rowCount()) {
        
        $check_password_sql = 'SELECT * FROM user where userEmail=:userEmail and userPassword=:userPassword';
        $check_password_stmnt = $conn->prepare($check_password_sql);
        $check_password_stmnt->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);
        $check_password_stmnt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
        $check_password_stmnt->execute();

        if($check_password_stmnt->rowCount()) {

            $response["userinfo"] = array();

            foreach ($check_password_stmnt as $details) {
                $userDetails = array();
                $userDetails["id"] = $details["userID"];
                $userDetails["name"] = $details["userName"];
                $userDetails["email"] = $details["userEmail"];
                $userDetails["image"] = $details["userImage"];
                array_push($response["userinfo"],$userDetails);
            }

            $response["success"] = 1;
            $response["message"] = "successfully logged in";
            echo json_encode($response);
            exit();
        } else {
            $response["success"] = 0;
		    $response["message"] = "invalid credentials!!";
            echo json_encode($response);
            exit();
        }
    } else {
        $response["success"] = 0;
		$response["message"] = "invalid credentials!!";
        echo json_encode($response);
        exit();
    }
?>
