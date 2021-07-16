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

    <title>CRUD App</title>
</head>

<body>
    <div class="container-fluid" style="width:80%">
        <header>
            <h2>CRUD Application</h2>
            <nav>
                <ul>
                    <li><a href="?path=employees">Employees</a></li>
                    <li><a href="?path=projects">Projects</a></li>
                </ul>
            </nav>
        </header>
        <table class="table table-bordered">
            <thead class="table-dark ">
                <tr>
                    <td style="width:10%">#</td>
                    <td style="width:25%">Employee</td>
                    <td style="width:35%">Project</td>
                    <td style="width:40%">Actions</td>
                </tr>
            </thead>
            <?php
            $title = $_GET['path'];
            if ($title == '' || $title == 'employees') {
                $stmt = $conn->prepare("SELECT id, name from employees WHERE id LIKE ?");
                $stmt->bind_param("s", $a = "%%");
                $stmt->execute();
                $stmt->bind_result($id, $name);
                $project = '';
            } else {
                $query = "SELECT projects.id as id , projects.name as project, group_concat(' ', employees.name) as name 
                    FROM projects
                    LEFT JOIN employees
                        ON projects.id = employees.Project_id
                        WHERE projects.name LIKE ? 
                        GROUP BY projects.id
                    ORDER BY name DESC";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $a = "%%");
                $stmt->execute();
                $stmt->bind_result($id, $project, $name);
            }

            while ($stmt->fetch()) {
                $count = $count + 1;
                echo "<tbody>";
                echo ('
                <tr>
                    <td>' . $count . '</td>
                    <td>' . $name . '</td>
                    <td>' . $project . '</td>
                    <td>
                        <form action="" method="post">                       
                        <input type = "hidden" name="id" value=' . $id . ' hidden >
                            <a class= "btn" href="?action=edit&id='  . $id . '&path='.$_GET['path'].'">Edit</a>
                            <a class = "btn" href="?action=delete&id='  . $id . '&path='.$_GET['path'].'">Delete</a>
                        </form>
                    </td>
                </tr>
            ');
                echo "</tbody>";
            }
            ?>
        </table>
    </div>
    <?php
    if (isset($_GET['action']) and $_GET['action'] === 'delete') {
        require 'delete.php';
    }
    if (isset($_GET['action']) and $_GET['action'] === 'edit') {
        require 'edit.php';
    }

    ?>

</body>

</html>