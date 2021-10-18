<?php 
 include("config/database_con.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="mt-4 container">
        <form action="question2.php" method="POST">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <h1>Election Application</h1>
                    <h4>Chceck Total Result Of Polling Unit Using LGA!</h4>
                    <div class="form-group">
                        <label for="lga_name" class="control-label">Select LGA:</label>
                            <div class="">
                                <select name="lga_id">
                                <option>select</option>
                                <?php
                                $sqli = "SELECT lga_id, lga_name FROM `lga`";
                                $result = mysqli_query($conn, $sqli);
                                while ($row = mysqli_fetch_array($result)){
                                ?>
                                    <option value="<?php echo $row['lga_id']; ?>">
                                    <?php echo $row['lga_name']; ?>
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
                        <th class="mr-2">LGA Name</th>
                        <th>Number Of Polling Unit(s)</th>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($_POST['submit'])){
                                $lga_id = $_POST['lga_id'];

                                if($lga_id != ""){
                                    $query = "SELECT l.lga_name, SUM(party_score) AS pollingResult 
                                        FROM announced_lga_results AS lr, lga AS l 
                                        WHERE l.lga_id = lr.lga_name AND lr.lga_name = $lga_id
                                        GROUP BY lr.lga_name";
                                    $query_run = mysqli_query($conn, $query);
                                }
                                if(mysqli_num_rows($query_run) > 0){
                                    while($row = mysqli_fetch_assoc($query_run)){
                            ?>
                            <tr>
                            <td><?php echo $row['lga_name'];?></td>
                            <td><?php echo $row['pollingResult'];?></td>
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
                    <p>Question 1: <a href="index.php">Question One</a></p>
                </div>
                <div>
                    <p>Question 3: <a href="question3.php">Question Three</a></p>
                </div>

    </div>
    <td><?php echo $row['lga_id'];?></td>
    <td><?php echo $row['lga_name'];?></td>
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</body>
</html>