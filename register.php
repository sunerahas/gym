<?php

require './db_connect.php';

if(!(isset($_POST['email']) and isset($_POST['phone']))){
	header("Location:./register.html?regSts=err");
}

if(!($_POST['password'] == $_POST['confirm_password'])){
	header("Location:./register.html?regSts=errComfirmPassw");
}else{




$email = $_POST['email'];
$phone = $_POST['phone'];
$user_name = $_POST['user_name'];
$password = $_POST['password'];




// prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO user_register (email,phone,user_name,password) VALUES (?,?,?,?)");


$stmt->bind_param("ssss", $email,$phone,$user_name,$password);

// set parameter and execute statement
$stmt->execute();


if (empty($stmt->error)) {
	setcookie('loginStatus', 'ok', time() + 3600*24, '/');
	header("Location:./register.html?regSts=success");

} else {
    header("Location:./register.html?regSts=err");
}

// close statement and connection
$stmt->close();
$conn->close();

}
