<?php
 if($_GET['path'] == 'employees' or $_GET['path'] == '' ){
    $sql = 'DELETE FROM employees WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $res = $stmt->execute();
    
    $stmt->close();
    mysqli_close($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER'], '?');
    die();
}

 if( $_GET['path'] == 'projects'){
    $sql = 'DELETE FROM Projects WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $res = $stmt->execute();
    
    $stmt->close();
    mysqli_close($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER'], '?');
    die();
}





