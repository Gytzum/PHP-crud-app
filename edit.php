<?php
include_once('database-connection.php');
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>CRUD app</title>
</head>

<body>
    <?php
        $tableName = $_GET['path'] == '' || $_GET['path'] == 'employees' ?  'employees' : 'projects' ;
        $getPlaceholder = "SELECT name from ".$tableName." WHERE id LIKE ?";
        $stmt = $conn->prepare($getPlaceholder);
        $stmt->bind_param('s', $_GET['id']);
        $res = $stmt->execute();
        $stmt->bind_result($name);
    while ($stmt->fetch()){
        echo
        '<form style="margin-left: 11%"action="" method="post">
            <input type = "text" style="width:300px; height:50px; font-size: 25px" name="name" placeholder="' . $name . '">
            <button class="btn-dark" style="cursor: pointer; width:200px; height:50px;" class= "edit-btn" type="submit">Submit</button>
        </form>';}
        // $stmt->close();
        // mysqli_close($conn);
    ?>
    
    <?php
    if(isset($_POST['name']) and !empty($_POST['name'])){
        $query = 'UPDATE crud_app.'.$tableName.' SET `name`="'.$_POST['name'].'" WHERE `id` LIKE ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $_GET['id']);
        $res = $stmt->execute();

        $stmt->close();
        mysqli_close($conn);
        header('Location: ' . $_SERVER['HTTP_REFERER'], '?');
        
    }
   
    ?>

</body>
</html>
