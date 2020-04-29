<?php include './connection.php' ?>
<?php include './showData.php' ?>

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
        showAllWorkers($conn);
        ?>

        <form class="col-md-6" action="connection.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter employee name" value="<?php echo $name ?>">
            </div>
            <div class="form-group">
                <label for="project_id">Project</label>
                <select name="project_id" id="" class="form-control">
                    <?php
                    showAllSelectOptions($conn);
                    ?>
                </select>

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