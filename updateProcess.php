<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$id = $_POST['submitUpdateId'];

require './db_connect.php';



    if(isset($_POST["submitUpdate"]) and $_POST["submitUpdate"] == "update" and $_POST['area_name'] and $_POST['gym_name'] and $_POST['gym_add'] and $_POST['trainer_name'] and $_POST['trainer_colifi'] and $_POST['pay_month'] and $_POST['pay_half_year'] and $_POST['yearly_price']){
       // print_r($_POST);
        $area_name = $_POST['area_name'];
        $gym_name = $_POST['gym_name'];
        $gym_add = $_POST['gym_add'];
        $trainer_name = $_POST['trainer_name'];
        $trainer_colifi = $_POST['trainer_colifi'];

        $pay_month = $_POST['pay_month'];
        $pay_half_year = $_POST['pay_half_year'];
        $yearly_price = $_POST['yearly_price'];
        $equip_name = "";




        if(isset($_FILES['files'])){
            $errors= array();
            $file_name_array = array();
            foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                $file_name = $_FILES['files']['name'][$key];
                $file_size =$_FILES['files']['size'][$key];
                $file_tmp =$_FILES['files']['tmp_name'][$key];
                $file_type=$_FILES['files']['type'][$key];   
                
                $equip_name =$equip_name.$area_name."-".$file_name.", ";
        
                // process the file as needed
                // for example, move it to a desired location and save its path to a variable
                $desired_location = "./images/gym-equp/" .$area_name."-".$file_name;
                move_uploaded_file($file_tmp,$desired_location);
                $file_name_array[] = $desired_location;
            }
        }
        




        // Prepare the statement
        $stmt = $conn->prepare("UPDATE gym_area SET area_name = ?,gym_name = ?,gym_add = ?,equip_name = ?,trainer_name = ?,trainer_cetifi = ?,pay_month = ?,pay_half_year = ?,pay_year = ? WHERE id = ?");

        // Bind the parameters
         $stmt->bind_param("sssssssssi", $area_name,$gym_name,$gym_add,$equip_name,$trainer_name,$trainer_colifi,$pay_month,$pay_half_year,$yearly_price,$id);
        

          // Prepare the statement
        //$stmt = $conn->prepare("UPDATE gym_area SET area_name = 'kandy' WHERE gym_area.id = 2");

        // Bind the parameters
        //$stmt->bind_param("i",2);
        
        // Execute the statement
        $stmt->execute();
   
   

        if ($conn->affected_rows > 0) {
            header("Location:./admin.php?update=success");
        } else {
            header("Location:./admin.php?update=success");
        }
        // Close the statement and the database connection
        $stmt->close();
        $conn->close();

    }

?>