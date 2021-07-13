<body>
    <?php  require_once './database-connection.php';

    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "crud_app";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) 
        die("Connection failed: " . mysqli_connect_error());

        
