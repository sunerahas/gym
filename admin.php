
<?php 

    if(!($_COOKIE['isAdmin'] == "yes")){
        header("Location:./Login.html");
    }

    require './db_connect.php';
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>




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

        body{
            background-color: #f2f2f2;
            margin : 0,
        }

        nav{
            width: 100%;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items:center;
            padding: 0px 40px 0px 40px;
            background-color: #FFC107;
        }

        .overview-box{
            border-radius: 15px;
            border: #FFC107 3px solid;
            width: 100%;
            height: 150px;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            font-weight: 900;

        }

        .overview-box h2{
            font-size: 50px;
        }

        .userBox{
            border-radius: 15px;
            background-color: #FFC107;
            width: 100%;
            height: 200px;
            padding: 15px;
            margin: 5px;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            font-weight: 900;
        }
    </style>
</head>
<body>

<nav>
    <a href="./index.html"><img src="./Images/Logo2.jpeg" alt="logo"></a>

    <button class="btn btn-dark text-worning" onclick="deleteCookie2()">LOG OUT</button>
</nav>



    <div class="container mt-5 mb-5">
        <div class="row w-100" style="display:flex; justify-content: center;align-items: center;">
            <div class="col-3 me-3">
                <div class="overview-box">
                    <h2 id="userCount">40</h2>
                    <h4 class="text-warning"> Users Count </h4>                    
                </div>
            </div>
            <div class="col-3">
            <div class="overview-box">
                    <h2 id="gymCount">50</h2>
                    <h4 class="text-warning"> Gyms Count </h4>                    
                </div>
            </div>
            <div class="col-3 ms-3">
            <div class="overview-box">
                    <h2 id="areaCount">50</h2>
                    <h4 class="text-warning"> Areas Count </h4>                    
                </div>
            </div>
        </div>
    </div>


  



    
<?php
        
        // prepare and bind the SQL statement for get all gyms count
        $stmt = $conn->prepare("SELECT COUNT(*) FROM gym_area");

        // set parameter and execute statement
        $stmt->execute();

        // bind result variables
        $result = $stmt->get_result()->fetch_assoc();

        $allGymCount = $result["COUNT(*)"];
        
        echo '' ; 
    

        // prepare and bind the SQL statement for get all users count
        $stmt = $conn->prepare("SELECT COUNT(*) FROM user_register");

        // set parameter and execute statement
        $stmt->execute();

        // bind result variables
        $result = $stmt->get_result()->fetch_assoc();
        $allUsersCount = $result["COUNT(*)"];    

    

        // prepare and bind the SQL statement for get all area count
        $stmt = $conn->prepare("SELECT COUNT(DISTINCT area_name) FROM gym_area");

        // set parameter and execute statement
        $stmt->execute();

        // bind result variables
        $result = $stmt->get_result()->fetch_assoc();
        $allareaCount = $result["COUNT(DISTINCT area_name)"];


        echo '
            <script>
                document.getElementById("userCount").innerText = "'.$allUsersCount.'"
                document.getElementById("gymCount").innerText = "'.$allGymCount.'"
                document.getElementById("areaCount").innerText = "'.$allareaCount.'"
            </script> '; 
       
?>


    <hr/>


    <div class="container pt-4">
     <h1>Add Gym Locations</h1>

    <form action="./insertGymLocations.php" method="post" class="mt-4 w-100" enctype="multipart/form-data">

    <div class="row w-100">
        <div class="col-6">
            <fieldset class="w-100">
                <legend>Gym Details</legend>
            
                <div class="form-row w-100">
                    <div class="col-lg-12 w-100">
                        <input type="text" name="area_name" placeholder="Area name" class="form-control w-100 my-3 p-4" required>
                    </div>
                </div>
            

                <div class="form-row w-100">
                    <div class="col-lg-12 w-100">
                        <input type="text" name="gym_name" placeholder="Gym name" class="form-control w-100 my-3 p-4" required>
                    </div>
                </div>

                <div class="form-row w-100">
                    <div class="col-lg-12 w-100">
                        <textarea  name="gym_add" placeholder="Gym address" class="form-control w-100 my-3 p-4" required></textarea>
                    </div>
                </div>

                <div class="form-row w-100">
                    <div class="col-lg-12 w-100">
                        <input type="file" name="files[]" placeholder="Equipments names" multiple class="form-control w-100 my-3 p-4">
                    </div>
                </div>
            </fieldset>

            <fieldset class="w-100">
                <legend>Trainer Details</legend>
            

                <div class="form-row w-100">
                    <div class="col-lg-12 w-100">
                        <input type="text" name="trainer_name" placeholder="Traniner name" class="form-control w-100 my-3 p-4" required>
                    </div>
                </div>

                <div class="form-row w-100">
                    <div class="col-lg-12 w-100">
                        <input type="text" name="trainer_colifi" placeholder="Trainer Qulification" class="form-control w-100 my-3 p-4" required>
                    </div>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-md btn-dark" >Upload Data</button>

        </div>

        <div class="col-6">

            <fieldset class="w-100">
                <legend>Prices</legend>
            

                <div class="form-row w-100">
                    <div class="col-lg-12 w-100">
                        <input type="text" name="pay_month" placeholder="Monthly price" class="form-control w-100 my-3 p-4" required>
                    </div>
                </div>

                <div class="form-row w-100">
                    <div class="col-lg-12 w-100">
                        <input type="text" name="pay_half_year" placeholder="Half yearly price" class="form-control w-100 my-3 p-4" required>
                    </div>
                </div>

                <div class="form-row w-100">
                    <div class="col-lg-12 w-100">
                        <input type="text" name="yearly_price" placeholder="Yearly price" class="form-control w-100 my-3 p-4" required>
                    </div>
                </div>
            </fieldset>


            
      
    </form>


    


        </div>
    </div>

     <hr class="mt-4 mb-4" style="height: 3px;">

    <div class="container pt-4 pb-4">
     <h1>Users </h1>
     

        <div class="row w-100">
            
            <?php 
            
                // prepare and bind the SQL statement for get all users count
                $stmt = $conn->prepare("SELECT * FROM user_register");

                // set parameter and execute statement
                $stmt->execute();

                // bind result variables
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-4">
                                <div class="userBox">
                                    <h3> '.$row["user_name"].'</h3>
                                    <h5 class="text-light"> '.$row["email"].'</h5>
                                    <h5> '.$row["phone"].'</h5>

                                    <a href="./deleteUser.php?id='.$row["id"].'"> <button class="btn btn-danger mt-3">DELETE</button> </a>
                                </div>
                            </div>';
                }
            
            ?>

        </div>
    </div>





    <hr class="mt-4 mb-4" style="height: 3px;">



    </div>
    

    
    
    
    <div class="table-responsive p-5">
    <h1 class="ms-5">All Gym Locations Data</h1>
  <table class="table p-5">
  <thead>
    <tr>
      <th scope="col">Area Name</th>
      <th scope="col">Gym Name</th>
      <th scope="col">Gym ads</th>
      <th scope="col">Equipment</th>
      <th scope="col">Trainer</th>
      <th scope="col">Qualification</th>
      <th scope="col">Monthly (INR)</th>
      <th scope="col">6 month (INR)</th>
      <th scope="col">Year (INR)</th>
      <th scope="col">---</th>
    </tr>
  </thead>
  <tbody id="all_gym_data">



  <?php
        
        // prepare and bind the SQL statement
        $stmt = $conn->prepare("SELECT * FROM gym_area");
       

        // set parameter and execute statement
        $stmt->execute();

        // bind result variables
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {

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


            echo '
            <tr>
           
                <th scope="row">'.$area_name.'</th>
                <td>'.$gym_name.'</td>
                <td>'.$gym_add.'</td>
                <td class="d-flex" title="'.$equip_name.'"><span style="width:100px" class="d-flex">'.substr($equip_name, 0, 10).'...</span></td>
                <td>'.$trainer_name.'</td>
                <td>'.$trainer_cetifi.'</td>
                <td>'.$pay_month.'</td>
                <td>'.$pay_half_year.'</td>
                <td>'.$pay_year.'</td>
                <td> <form action="./delete.php" method="post"> <input type="hidden" name="delete_gym_row" value="'.$gym_id.'"> <button type="submit" class="btn"> <i class="fa-solid fa-trash text-danger"></i> </button> </form> </td>
                <td> <form action="./update.php" method="post"> <input type="hidden" name="update_gym_row" value="'.$gym_id.'"> <button type="submit" class="btn"> <i class="fa-solid fa-pen-to-square text-success"></i> </button> </form> </td>
                
            </tr>
    ';

        }

        
        // close statement and connection
        $stmt->close();
        $conn->close();
        
        ?>

   </tbody>
  </table>
</div>














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