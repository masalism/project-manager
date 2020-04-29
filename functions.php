<?php

include './connection.php';

function showAllWorkers($conn)
{
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

    echo "</tbody></table>";
}

function showAllSelectOptions($conn)
{
    $sql = ("SELECT * FROM projects;") or die("Connection failed: " . mysqli_connect_error());
    $result = mysqli_query($conn, $sql);

    $project_id = null;
    $name = "------";

    if (mysqli_num_rows($result) > 0) {
        echo "<option value=\"$project_id\" >$name</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $project_id = $row['project_id'];
            $name = $row['project_name'];
            echo "<option value=\"$project_id\" >$name</option>";
        }
    }

    mysqli_close($conn);
}

function showAllProjects($conn) {
    $sql = "SELECT p.project_id, p.project_name, group_concat(w.worker_name SEPARATOR ', ') as worker_name
    from projects p
    left outer join workers w
    on w.project_id = p.project_id
    group by p.project_id;";

    $result = mysqli_query($conn, $sql);

    echo "<table class=\"table\"><thead><tr><th>Projekto ID</th><th>Projektas</th><th>Darbuotojas priskirtas projektui</th><th>Veiksmai</th></tr></thead><tbody>";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['project_id'] . "</td>";
            echo "<td>" . $row['project_name'] . "</td>";
            echo "<td>" . $row['worker_name'] . "</td>";
            echo "<td><a href=\"connection.php?projectdelete=" . $row['project_id'] . "\" class=\"btn btn-sm btn-danger mr-2\">Delete </a><a href=\"?editproject=" . $row['project_id'] . "\" class=\"btn btn-sm btn-success\"> Update</a></td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);

    echo "</tbody></table>";
    
}

    