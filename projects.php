<?php
include './connection.php';
include './functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Project Manager</title>
</head>

<body>
    <div class="container">

        <a class="m-3 btn btn-primary d-inline-block" href="index.php">Darbuotojai</a>
        <a class="m-3 btn btn-secondary d-inline-block" href="projects.php">Projektai</a>

        <?php showAllProjects($conn); ?>


        <form action="connection.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="form-group">
                <label for="project_name">Project Name</label>
                <input type="text" name="project_name" class="form-control" placeholder="Enter project name" value="<?php echo $name ?>">
            </div>
            <div class="form-group">
                <?php
                if ($update == true) :
                ?>
                    <button class="btn btn-info" type="submit" name="update_project">Update Project</button>
                <?php else : ?>
                    <button class="btn btn-primary" type="submit" name="insert_project">Insert Project</button>
                <?php endif; ?>
            </div>

        </form>

    </div>
</body>

</html>