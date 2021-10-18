<?php 
 include("config/database_con.php");
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="mt-4 container">
        <form action="index.php" method="POST">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <h1>Election Application</h1>
                    <h4>Chceck Polling Unit Result!</h4>
                    <div class="form-group">
                        <label for="polling_unit" class="control-label">Select A Polling Unit:</label>
                            <div class="">
                                <select id="mobile" name="polling_unit">
                                <option>select</option>
                                <?php
                                $sqli = "SELECT DISTINCT polling_unit_uniqueid FROM `announced_pu_results`";
                                $result = mysqli_query($conn, $sqli);
                                while ($row = mysqli_fetch_array($result)){
                                ?>
                                    <option value="<?php echo $row['polling_unit_uniqueid']; ?>">
                                    <?php echo $row['polling_unit_uniqueid']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                    </div>

                    <div class="form-group col-md-2 mt-2">
                        <div class="">
                            <input type="submit" name="submit" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </form>


                <table class="table table-striped table-hover">
                    <thead>
                        <th class="mr-2">Polling Unit</th>
                        <th>Result Of Polling Unit</th>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($_POST['submit'])){
                                $polling_unit = $_POST['polling_unit'];

                                if($polling_unit != ""){
                                    $query = "SELECT sum(party_score), polling_unit_uniqueid FROM announced_pu_results where polling_unit_uniqueid = $polling_unit group by polling_unit_uniqueid";
                                    $query_run = mysqli_query($conn, $query);
                                }
                                if(mysqli_num_rows($query_run) > 0){
                                    while($row = mysqli_fetch_assoc($query_run)){
                            ?>
                            <tr>
                            <td><?php echo $row['polling_unit_uniqueid'];?></td>
                            <td><?php echo $row['sum(party_score)'];?></td>
                            </tr>
                            <?php
                                    }

                                }
                            else{
                                ?>
                                <tr>
                                 <td>No record found!</td>
                                </tr>
                                <?php
                            }
                            }
                        ?>
                    </tbody>
                </table>

                <div>
                    <p>Question 2: <a href="question2.php">Click here</a></p>
                </div>

    </div>

    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>