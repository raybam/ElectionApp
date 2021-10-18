<?php 
 include("config/database_con.php");

 $errors =array();

 if(isset($_POST['addPollingResult'])){
     $pollingUnit = $_POST['pollingUnit'];
     $partys = $_POST['partys'];
     $polling_unit_result = $_POST['polling_unit_result'];
     $pollingUser = $_POST['pollingUser'];

     if(empty($pollingUnit)) {
         $errors['pollingUnit'] = "Polling Unit required!";
    }
     if(empty($polling_unit_result)) {
         $errors['polling_unit_result'] = "Polling Unit result required!";
    }
     if(empty($pollingUser)) {
         $errors['pollingUsert'] = "Enter User!";
    }

     if(count($errors) === 0){
         $query = "INSERT INTO announced_pu_results (polling_unit_uniqueid, party_abbreviation, party_score, entered_by_user) 
         VALUES ('$pollingUnit', '$partys', '$polling_unit_result', '$pollingUser')";
         $query_run = mysqli_query($conn, $query);

         if($query_run){
             echo "Record Inserted!";
         }else{
            $errors['db_error'] = "Database Error!";
         }
     }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="col-md-4 offset-md-4">
        <h1>Election Application</h1>
        <h4>Save New Polling Unit Result!</h4>
        <div class="form-group">
            <form action="question3.php" method="POST">
            <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

                <div class="form-group">
                    <label for="polling_unit">Enter Polling Unit:</label>
                    <input type="text" name="pollingUnit" >
                </div>

                <div class="form-group">
                        <label for="party" class="control-label">Select Party:</label>
                            <div class="">
                                <select name="partys">
                                <option>select</option>
                                <?php
                                $sqli = "SELECT * FROM `party`";
                                $result = mysqli_query($conn, $sqli);
                                while ($row = mysqli_fetch_array($result)){
                                ?>
                                    <option value="<?php echo $row['partyname']; ?>">
                                    <?php echo $row['partyname']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                </div>

                <div class="form-group">
                    <label for="polling_result">Enter Polling Unit Result:</label>
                    <input type="text" name="polling_unit_result" >
                </div>

                <div class="form-group">
                    <label for="pollingUser">Enter User Name:</label>
                    <input type="text" name="pollingUser" >
                </div>

                <div class="form-group col-md-2 mt-2">
                        <div class="">
                            <input type="submit" name="addPollingResult" class="btn btn-primary">
                        </div>
                    </div>
            </form>
        </div>
                <div>
                    <p>Question 1: <a href="index.php">Question One</a></p>
                </div>

                <div>
                    <p>Question 2: <a href="question2.php">Question Two</a></p>
                </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>