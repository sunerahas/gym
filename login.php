

<?php

require './db_connect.php';


if(!(isset($_POST['emailLog']) and isset($_POST['passwordLog']))){
	header("Location:./Login.html?logSts=err");
}



$emailLog = $_POST['emailLog'];
$passwordLog = $_POST['passwordLog'];


// prepare and bind the SQL statement
$stmt = $conn->prepare("SELECT password FROM user_register WHERE email = ?");
$stmt->bind_param("s", $emailLog);

// set parameter and execute statement
$stmt->execute();

// bind result variables
//$stmt->bind_result($passwordResult);
$passwordResult = $stmt->get_result()->fetch_assoc()['password'];

//echo $passwordResult;
if($passwordResult === $passwordLog ){
    setcookie('loginStatus', 'ok', time() + 3600*24, '/');

    if($emailLog === "admin@gmail.com" ){
        setcookie('isAdmin', 'yes', time() + 3600*24, '/');
    }


    header("Location:./index.html?logSts=success");
}else{
    header("Location:./Login.html?logSts=err");
}


// close statement and connection
$stmt->close();
$conn->close();



?>