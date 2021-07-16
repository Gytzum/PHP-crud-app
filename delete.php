<?php

    $tableName = $_GET['path'] == '' || $_GET['path'] == 'employees' ?  'employees' : 'projects' ;
     $sql = 'DELETE FROM '.$tableName.' WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $res = $stmt->execute();
    
    $stmt->close();
    mysqli_close($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER'], '?');
    die();





