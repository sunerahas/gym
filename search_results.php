<?php 

require './db_connect.php';


if(!(isset($_POST['location']))){
	header("Location:./index.html");
}

if(!(isset($_COOKIE['loginStatus']) and $_COOKIE['loginStatus'] === 'ok') ){
	header("Location:./login.html");
}


$location =strtolower($_POST['location']);



// prepare and bind the SQL statement
$stmt = $conn->prepare("SELECT * FROM gym_area WHERE area_name = ?");
$stmt->bind_param("s", $location);

// set parameter and execute statement
$stmt->execute();

// bind result variables
//$stmt->bind_result($passwordResult);
$gyms = $stmt->get_result();

//echo "<pre>";

//echo "</pre>";

//echo $passwordResult;


//close statement and connection
$stmt->close();
$conn->close();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search result</title>


     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
    body {
      background-color: #f8f8f8;
      font-family: Arial, sans-serif;
      color: #333;
    }

    h1 {
      text-align: center;
      margin: 50px 0 30px;
    }

    .gym-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      height: 250px !important;
      text-transform: capitalize;
    }

    .gym-card {
      width: calc(33.33% - 20px);
      background-color: #FFC107;
      padding: 20px;
      margin-bottom: 20px;
      text-align: center;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      box-sizing: border-box;
    }

    .gym-card:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .gym-name {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #000;
    }

    .gym-type {
      font-size: 16px;
      color: #fff;
      margin-bottom: 10px;
    }

    .gym-location {
      font-size: 16px;
      margin-bottom: 10px;
      color: #fff;
    }

    .explore-button {
      display: inline-block;
      background-color: #000;
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 5px;
      margin-top: 10px;
      text-decoration: none;
    }

    .explore-button:hover {
      background-color: #222;
    }

    .gym-rea-title{
        font-weight:900;
    }


    #expore-wrapper{
        width: 100%;
        height: 100%;
        display: none;
    }

    .expore-fade{
        width: 100%;
        height: 100%;
        background-color: #0900007c;
        position:absolute;
        left: 0;
        top: 0;

        display: flex;
        justify-content: center;
        align-items: center;


    }

  

    .expore-box{
        width: 80%;
        height:80%;
        background-color: #FFC107;
        border-radius: 10px;
        padding: 50px;
        text-transform: capitalize;
        font-weight: bold;
        scroll-behavior: smooth;
        overflow-y: scroll;
    }

    .expore-box img{
        height: 200px;
        border-radius: 5px;
    }

    .equipment-packege-box{
        border: #000 2px solid;
        border-radius: 10px;
        font-weight: 900 !important;

        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
    }

    
  </style>

</head>
<body>

<div class="logo"><img src="images/GymLocator Logo.jpeg" class="logo-img"></div>
     <div class="navbar">
       <a href="index.html">Home</a>
       <a href="about.html">About</a>
       <div class="login-register">
         <a href="Login.html" id="loginButton">Login </a> <a href="#" id="logoutButton" onclick="deleteCookie()">Log Out</a> <a href="register.html"> Register</a>
       </div>
     </div>
    

<h1 class="fw-bolder gym-rea-title" >Gyms in  <span style="color:#FFC107"><?php echo $location; ?></h1>

<div class="row d-flex w-100 p-4">
    <?php 

    
    if($gyms->num_rows === 0){
        echo '<h4 class="text-muted text-center fw-bold" > No gyms found in the area </h4>';
    }

    while ($row = $gyms->fetch_assoc()) {

        //print_r($row);
        $gym_id = $row['id'];
        $area_name = $row['area_name'];
        $gym_name = $row['gym_name'];
        $gym_add = $row['gym_add'];
        $trainer_name = $row['trainer_name'];
        $trainer_cetifi = $row['trainer_cetifi'];
        $pay_month = $row['pay_month'];
        $pay_half_year = $row['pay_half_year'];
        $pay_year = $row['pay_year'];
        $equip_name = $row['equip_name'];


        echo '<div class="gym-list col-3">
                    <div class="gym-card w-100" id="gym'.$gym_id.'">
                        <div class="gym-name">'.$gym_name.'</div>
                        <div class="gym-location">'.$gym_add.'</div>
                        <a class="explore-button" href="#" onclick="open_popup(`'.$gym_name.'`,`'.$trainer_name.'`,`'.$trainer_cetifi.'`,`'.$pay_month.'`,`'.$pay_half_year.'`,`'.$pay_year.'`,`'.$equip_name.'`,`'.$area_name.'`)">Explore</a>
                    </div>
                </div>';

       
    }


    
    ?>
</div>

<div id="expore-wrapper">

    <div class = "expore-fade">
        <div class = "expore-box">
        <button type="button" class="btn" style="font-size:25px" onclick="un_popup()"> <i class="fa-regular fa-circle-xmark"></i></button>
                <h3 id="name-of-gym" class=" fw-bold text-center">gym</h3>

                <h4 class=" fw-bold">Trainer Name: <span class="text-light" id="trainer-name"></span></h4>
                <h4 class=" fw-bold">Trainer Qualifications: <span class="text-light" id="trainer-colifi"> </span></h4>
                <h4 class="equipment fw-bold">Equipment:</h4>
                <div class="row w-100" id="equip_display_box">
                
                
                </div>

                <h4 class="equipment-packege fw-bold mt-3 mb-3 pt-4 pb-4">Packeges:</h4>
                <div class="row w-100 ">
                
                    <div class="col-4 equipment-packege-box">
                    <h2 class="text-center text-light pt-5" id="packege-month"></h2>
                        <h5 class=" text-center">Monthly</h5>

                        <p class="text-muted text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maiores cumque cum commodi vel et quos quo architecto omnis nam earum</p>

                        <button class="btn btn-dark m-4" style="width:150px;height:35px">PAY NOW</button>
                    </div>
                    <div class="col-4 equipment-packege-box">
                    <h2 class="text-center text-light pt-5 " id="packege-half-year"></h2>
                        <h5 class=" text-center">Harf Yearly</h5>

                        <p class="text-muted text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maiores cumque cum commodi vel et quos quo architecto omnis nam earum</p>

                        <button class="btn btn-dark m-4" style="width:150px;height:35px">PAY NOW</button>
                        
                    </div>
                    <div class="col-4 equipment-packege-box">
                        <h2 class="text-center text-light pt-5" id="packege-year"></h2>
                        <h5 class=" text-center">Yearly</h5>

                        <p class="text-muted text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maiores cumque cum commodi vel et quos quo architecto omnis nam earum</p>

                        <button class="btn btn-dark m-4" style="width:150px;height:35px">PAY NOW</button>
                        
                    </div>
                </div>
        </div>
    </div>
    <div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <!-- font awesome cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="./main.js"></script>
        <script src="./search_result.js"></script>
</body>
</html>