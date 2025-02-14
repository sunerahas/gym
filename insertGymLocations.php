

<?php
require './db_connect.php';

print_r($_POST);
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

    echo "<pre>";
    echo sizeof($_FILES['files']['name']);
    echo "</pre>";

    $errors= array();
    $file_name_array = array();

    foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
        $file_name = $_FILES['files']['name'][$key];
        $file_size =$_FILES['files']['size'][$key];
        $file_tmp =$_FILES['files']['tmp_name'][$key];
        $file_type=$_FILES['files']['type'][$key];   


    
        
        $equip_name =$equip_name.$area_name."-".preg_replace('/\s+/', '', $gym_name)."-".$file_name.",";

        // process the file as needed
        // for example, move it to a desired location and save its path to a variable
        $desired_location = "./images/gym-equp/" .$area_name."-".preg_replace('/\s+/', '', $gym_name)."-".$file_name;
        move_uploaded_file($file_tmp,$desired_location);
        $file_name_array[] = $desired_location;
    }
}



echo $equip_name;

$stmt = $conn->prepare("INSERT INTO gym_area (area_name,gym_name,gym_add,equip_name,trainer_name,trainer_cetifi,pay_month,pay_half_year,pay_year) VALUES (?,?,?,?,?,?,?,?,?)");

// Bind the actual values to the placeholders
$stmt->bind_param("sssssssss", $area_name,$gym_name,$gym_add,$equip_name,$trainer_name,$trainer_colifi,$pay_month,$pay_half_year,$yearly_price);


// Execute the prepared statement
$stmt->execute();

header("Location:./admin.php");


$stmt->close();
$conn->close();

?>