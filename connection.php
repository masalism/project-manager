<?php

$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "projectmanager";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = 0;
$name = '';
$project_id = '';
$update = false;
$project_edit = 0;

// Delete worker
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = ("DELETE FROM workers WHERE worker_id=$id;") or die("Connection failed: " . mysqli_connect_error());
    $result = mysqli_query($conn, $sql);

    header("Location: index.php");
}

// Insert Worker with project id
if (isset($_POST['insert_worker'])) {
    $name = $_POST['name'];
    $project_id = $_POST['project_id'];

    if ($project_id == '') {
        $sql = ("INSERT INTO workers (worker_name) VALUES ('$name');") or die("Connection failed: " . mysqli_connect_error());
        $result = mysqli_query($conn, $sql);
    } else {
        $sql = ("INSERT INTO workers (worker_name, project_id) VALUES ('$name', '$project_id');") or die("Connection failed: " . mysqli_connect_error());
        $result = mysqli_query($conn, $sql);
    }

    header("Location: index.php");
}

//  Edit worker
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $sql = ("SELECT * FROM workers WHERE worker_id=$id") or die("Connection failed: " . mysqli_connect_error());
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows) {
        $row = $result->fetch_array();
        $name = $row['worker_name'];
        $project_id = $row['project_id'];
    }
}

// Update worker
if (isset($_POST['update_worker'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $project_id = $_POST['project_id'];
   
    if ($project_id == '') {
        $sql = ("UPDATE workers SET worker_name='$name', project_id=null WHERE worker_id=$id;") or die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = ("UPDATE workers SET worker_name='$name', project_id='$project_id' WHERE worker_id=$id;") or die("Connection failed: " . mysqli_connect_error());
    }

    $result = mysqli_query($conn, $sql);

    header("Location: index.php");
}

if (isset($_GET['projectdelete'])) {
    $id = $_GET['projectdelete'];
    $sql = ("DELETE FROM projects WHERE project_id=$id;") or die("Connection failed: " . mysqli_connect_error());
    $result = mysqli_query($conn, $sql);

    header("Location: projects.php");
}

// Insert project
if (isset($_POST['insert_project'])) {
    $name = $_POST['project_name'];

    $sql = ("INSERT INTO projects (project_name) VALUES ('$name');") or die("Connection failed: " . mysqli_connect_error());
    $result = mysqli_query($conn, $sql);

    header("Location: projects.php");
}

// edit project
if (isset($_GET['editproject'])) {
    $id = $_GET['editproject'];
    $update = true;
    $sql = ("SELECT * FROM projects WHERE project_id=$id") or die("Connection failed: " . mysqli_connect_error());
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows) {
        $row = $result->fetch_array();
        $name = $row['project_name'];
    }
}

// Update project
if (isset($_POST['update_project'])) {
    $id = $_POST['id'];

    $name = $_POST['project_name'];
    $sql = ("UPDATE projects SET project_name='$name' WHERE project_id=$id;") or die("Connection failed: " . mysqli_connect_error());

    $result = mysqli_query($conn, $sql);

    header("Location: projects.php");
}
