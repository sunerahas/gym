<?php 

require './db_connect.php';

if(isset($_POST['update_gym_row'])){

    $row_id = $_POST['update_gym_row'];
    $id = $row_id;
}


    // prepare and bind the SQL statement
    $stmt = $conn->prepare("SELECT * FROM gym_area WHERE id = ?");
    $stmt->bind_param("i", $id);

    // set parameter and execute statement
    $stmt->execute();

    $res = $stmt->get_result()->fetch_assoc();

    $area_name = $res['area_name'];
    $gym_name =$res['gym_name'];
    $gym_add = $res['gym_add'];
    $trainer_name = $res['trainer_name'];
    $trainer_colifi = $res['trainer_cetifi'];

    $pay_month = $res['pay_month'];
    $pay_half_year = $res['pay_half_year'];
    $yearly_price = $res['pay_year'];
    $equip_name = $res['equip_name'];

 

    // close statement and connection
    $stmt->close();
    $conn->close();






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Update </title>


    
      <!-- Required meta tags -->
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body>
    


<div class="container">


<h1 class="mt-5 mb-5 text-warning">Add Gym Locations</h1>

 

<form action="./updateProcess.php" method="post" class="mt-4 w-100 mb-4" enctype="multipart/form-data">


<div class="row w-100">
    <div class="col-6">
        <fieldset class="w-100">
            <legend>Gym Details</legend>
        
            <div class="form-row w-100">
                <div class="col-lg-12 w-100">
                    <input type="text" name="area_name" value="<?php echo $area_name; ?>" placeholder="Area name" class="form-control w-100 my-3 p-4" required>
                </div>
            </div>
        

            <div class="form-row w-100">
                <div class="col-lg-12 w-100">
                    <input type="text" name="gym_name" value="<?php echo $gym_name; ?>" placeholder="Gym name" class="form-control w-100 my-3 p-4" required>
                </div>
            </div>

            <div class="form-row w-100">
                <div class="col-lg-12 w-100">
                    <textarea  name="gym_add" id="updateTextArea"  placeholder="Gym address" class="form-control w-100 my-3 p-4" required></textarea>
                </div>
            </div>

            <script>
                document.getElementById("updateTextArea").innerText = "<?php echo $gym_add; ?>";
            </script>

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
                    <input type="text" name="trainer_name" value="<?php echo $trainer_name; ?>" placeholder="Traniner name" class="form-control w-100 my-3 p-4" required>
                </div>
            </div>

            <div class="form-row w-100">
                <div class="col-lg-12 w-100">
                    <input type="text" name="trainer_colifi" value="<?php echo $trainer_colifi; ?>" placeholder="Trainer Qulification" class="form-control w-100 my-3 p-4" required>
                </div>
            </div>
        </fieldset>

        <button type="submit" class="btn btn-md btn-dark" >Update Data</button>

    </div>

    <div class="col-6">

        <fieldset class="w-100">
            <legend>Prices</legend>
        

            <div class="form-row w-100">
                <div class="col-lg-12 w-100">
                    <input type="text" name="pay_month" value="<?php echo $pay_month; ?>" placeholder="Monthly price" class="form-control w-100 my-3 p-4" required>
                </div>
            </div>

            <div class="form-row w-100">
                <div class="col-lg-12 w-100">
                    <input type="text" name="pay_half_year" value="<?php echo $pay_half_year; ?>" placeholder="Half yearly price" class="form-control w-100 my-3 p-4" required>
                </div>
            </div>

            <div class="form-row w-100">
                <div class="col-lg-12 w-100">
                    <input type="text" name="yearly_price" value="<?php echo $yearly_price; ?>" placeholder="Yearly price" class="form-control w-100 my-3 p-4" required>
                </div>
            </div>
        </fieldset>

    <input type="hidden" value="update" name="submitUpdate">
    <input type="hidden" value="<?php echo $id; ?>" name="submitUpdateId">
        
  
</form>


    </div>
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