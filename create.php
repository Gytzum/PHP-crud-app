<?php 
    
    $tableName = $_GET['path'] == '' || $_GET['path'] == 'employees' ?  'employees' : 'projects' ;
    $sql = 'INSERT INTO crud_app.'.$tableName.' (name) VALUES (?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_POST['create']);
    $res = $stmt->execute();
    
    $stmt->close();
    mysqli_close($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER'], '?');
    die;
?>