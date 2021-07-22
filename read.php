<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">

    <title>CRUD App</title>
</head>

    <?php
    $tableName = $_GET['path'] == '' || $_GET['path'] == 'employees' ?  'employees' : 'projects';
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
                        GROUP BY projects.id";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $a = "%%");
        $stmt->execute();
        $stmt->bind_result($id, $project, $name);
    }
    ?>
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
        <div style=" margin-top: 30px; margin-bottom: 30px">
            <form action="" method="post">
                <label for="name" style="font-size: 30px;">Create new <?php echo substr_replace($_GET['path'], "", -1) ?></label> </br>
                <input type="text" type="text" style="width:300px; height:50px; font-size: 25px" placeholder="Enter name" name="create">
                <button class="btn-dark" style="cursor: pointer; width:200px; height:50px;" type="submit">Submit</button>
            </form>
        </div>
        <table class="table table-bordered">
            <thead class="table-dark ">
                <tr>
                    <td style="width:10%">#</td>
                    <td style="width:25%">Employees</td>
                    <td style="width:35%">Projects</td>
                    <td style="width:40%">Actions</td>
                </tr>
            </thead>
            <?php
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
                        <input class = "table-btn" type = "hidden" name="id" value=' . $id . ' hidden >
                            <a class="update-btn" href="?action=edit&id='  . $id . '&path=' . $_GET['path'] . '">Edit</a>
                            <a class= "del-btn"href="?action=delete&id='  . $id . '&path=' . $_GET['path'] . '">Delete</a>
                        </form>
                    </td>
                </tr>
            ');
                echo "</tbody>";
            }
            ?>
        </table>
    </div>

</html>
