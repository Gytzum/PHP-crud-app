<?php
include_once('database-connection.php');
// include_once('functions.php');
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
<?php
$title = $_GET['path'];
print($title);
if ($title == 'employees') {
    $content = "
            SELECT employees.id, name, group_concat(' ', project_name) as project FROM projects
                JOIN employees
                    ON employees.id = projects.employee_id
            GROUP BY employees.id;";
} else {
    $content = "
            SELECT projects.id, project_name as 'Project Name', group_concat(' ', employees.name) as name FROM employees
                JOIN projects
                    ON projects.id = employees.id
            GROUP BY projects.id;";
}

?>

<body>
    <div class="container">
        <header>
            <h2>CRUD Application</h2>
            <nav>
                <ul class="nav-links">
                    <li><a href="?path=employees">Employees</a></li>
                    <li><a href="?path=projects">Projects</a></li>
                </ul>
            </nav>
        </header>


            <table class="table table-dark">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Employee</td>
                    <td>Project</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>;
    </div>

</body>

</html>