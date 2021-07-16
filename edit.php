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
    <title>CRUD app</title>
</head>

<body>
    <?php
    $getPlaceholder = "SELECT name from projects WHERE id LIKE ?";
    $stmt = $conn->prepare($getPlaceholder);
    $stmt->bind_param('s', $_GET['id']);
    $res = $stmt->execute();
    $stmt->bind_result($name);
    while ($stmt->fetch())
        echo
        '<form action="" method="post">
        <input name="name" placeholder="' . $name . '">
        <button type="submit">Submit</button>
    </form>';

    ?>

    <?php
    $stmt->close();
    mysqli_close($conn);
    ?>

</body>
</html>
