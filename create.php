<?php 

    echo "gyvas";
    echo $_POST['create'];
    
    $tableName = $_GET['path'] == '' || $_GET['path'] == 'employees' ?  'employees' : 'projects' ;
    $sql = 'INSERT INTO crud_app.'.$tableName.' (name) VALUES (?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_POST['create']);
    if($stmt) echo "pavyko";
    $res = $stmt->execute();
    
    $stmt->close();
    mysqli_close($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER'], '?');
    die;
?>