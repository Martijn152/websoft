<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Read page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/schools.css">
    <link rel="icon" href="favicon.ico">
</head>

<body>
<div id='duck' style="height: 100px; width: 100px; position: absolute"></div>


<header>
    <?php
    include 'view/header.php';
    ?>
</header>


<article>

    <h1>Read the contents of the tech table</h1>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "websoft";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully <br>";

    $sql = "SELECT id, label, type FROM tech";
    $result = $conn->query($sql);


    ?>

    <p style="font-style:italic">Clicking the Delete or Update links will take you to a page where you can finish the operation in question. The row you have selected will be pre-filled into the needed fields.</p>

    <table>
        <tr>
            <th>Id</th>
            <th>Label</th>
            <th>Type</th>
            <th>UPDATE</th>
            <th>DELETE</th>
        </tr>

        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["label"] . "</td>";
                echo "<td>" . $row["type"] . "</td>";
                echo "<td><a href='delete.php?selected=" . $row["label"] . "'>Delete</a></td>";
                echo "<td><a href='update.php?selected=" . $row["label"] . "'>Update</a></td>";
                echo "</tr>";


                //echo "id: " . $row["id"] . " - Name: " . $row["label"] . " " . $row["type"] . " < br>";
            }
        } else {
            echo "0 results";
        }
        ?>

        <tr>
            <td><a href='create.php'>Create</a></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

    </table>

    <?php
    $conn->close();
    ?>


</article>

<footer>
    <?php
    include 'view/footer.php';
    ?>
</footer>

<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
