<?php 
 if(isset($_GET['action']) and $_GET['action'] == 'delete'){
    $sql = 'DELETE FROM Employees WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $res = $stmt->execute();
    
    $stmt->close();
    mysqli_close($conn);
header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));

    die();
}
    

?>