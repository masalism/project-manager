<?php include './connection.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <a class="m-3 btn btn-primary d-inline-block" href="index.php">Darbuotojai</a>
        <a class="m-3 btn btn-secondary d-inline-block" href="projects.php">Projektai</a>

        <?php

        $sql = "SELECT w.worker_id, w.worker_name, p.project_name 
                from workers w
                left outer join projects p
                on w.project_id = p.project_id
                order by w.worker_id;";

        $result = mysqli_query($conn, $sql);

        echo "<table class=\"table\"><thead><tr><th>ID</th><th>Vardas</th><th>Projektas</th><th>Veiksmai</th></tr></thead><tbody>";

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['worker_id'] . "</td>";
                echo "<td>" . $row['worker_name'] . "</td>";
                echo "<td>" . $row['project_name'] . "</td>";
                echo "<td>
            <a href=\"connection.php?delete=" . $row['worker_id'] . "\"  class=\"btn btn-sm btn-danger mr-2\" >Delete </a><a href=\"index.php?edit=" . $row['worker_id'] . "\" class=\"btn btn-sm btn-success mr-2\"> Update</a>
        </td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }

        mysqli_close($conn);

        echo "</tbody></table>";
        ?>

        <form action="connection.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter employee name" value="<?php echo $name ?>">
            </div>
            <div class="form-group">
                <label for="project_id">Project ID</label>
                <input type="number" name="project_id" value="<?php echo $project_id ?>" class="form-control" placeholder="Enter project ID">
            </div>
            <div class="form-group">
                <?php
                if ($update == true) :
                ?>
                    <button class="btn btn-info" type="submit" name="update_worker">Update Employee</button>
                <?php else : ?>
                    <button class="btn btn-primary" type="submit" name="insert_worker">Insert Employee</button>
                <?php endif; ?>
            </div>

        </form>




    </div>



</body>

</html>