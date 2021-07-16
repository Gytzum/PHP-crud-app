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
    $path = $_GET['path'];
    $tableName = $path == '' || $path == 'employees' ?  'employees' : 'projects';
    $getPlaceholder = "SELECT name from " . $tableName . " WHERE id LIKE ?";
    $stmt = $conn->prepare($getPlaceholder);
    $stmt->bind_param('i', $_GET['id']);
    $res = $stmt->execute();
    $stmt->bind_result($name);
    while ($stmt->fetch()) {
        echo
        '<form style="margin-left: 11%"action="" method="post">
            <p style = "font-size:25px">Change ' . substr_replace($path, "", -1) . ' name</p>
            <input type = "text" style="width:300px; height:50px; font-size: 25px" name="name" placeholder="' . $name . '">
            <button class="btn-dark" style="cursor: pointer; width:200px; height:50px;" class= "edit-btn" type="submit">Submit</button>
        </form>';
    }
    if ($path !== 'projects') {
        $stmt = $conn->prepare("SELECT name FROM crud_app.projects");
        $res = $stmt->execute();
        $stmt->bind_result($option);

        echo '
            <form action="" method = "post">
                <label style = "font-size:25px; margin-left: 11%; margin-top: 30px" for="assign">Choose project to assign employee</label></br>
                    <select style="margin-left: 11%; width:300px; height:50px" name="assign">';
        while ($stmt->fetch()) {
            echo '<option  value="' . $option . '">' . $option . '</option>';
        }
        echo '</select>';
        echo '<button class="btn-dark" style="cursor: pointer; width:200px; height:50px;" class= "edit-btn" type="submit">Assign</button>';
    }
    echo ' </form>';
    ?>

    <?php
    if (isset($_POST['name']) and !empty($_POST['name'])) {
        $query = 'UPDATE crud_app.' . $tableName . ' SET `name`="' . $_POST['name'] . '" WHERE `id` LIKE ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $_GET['id']);
        $res = $stmt->execute();

        $stmt->close();
        mysqli_close($conn);
        header('Location: ' . $_SERVER['HTTP_REFERER'], '?');
    }

    if (isset($_POST['assign'])) {
        $getProjectId = 'SELECT id FROM crud_app.projects WHERE name = ?';
        $stmt = $conn->prepare($getProjectId);
        $stmt->bind_param('s', $_POST['assign']);
        $res = $stmt->execute();
        $stmt->bind_result($projectId);
        while ($stmt->fetch()) $finalId = $projectId;

        echo $_GET['id'];
        $query = 'UPDATE crud_app.employees SET Project_id = ' . $finalId . ' WHERE id = ' . $_GET['id'] . '';

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