<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Update page</title>
    <link rel="stylesheet" href="css/style.css">
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

    <h1>Update an existing row</h1>

    <form action="/php/update.php" method="get">

        <input type="text" name="originalLabel" placeholder="original label"
            <?php
            if (isset($_GET['selected'])) {
                echo "value='" . $_GET['selected'] . "'";
            }
            ?>
        ><br><br>

        <input type="text" name="label" placeholder="new label">
        <input type="text" name="type" placeholder="new type"><br><br>

        <input type="submit" value="Submit"><br>

    </form>

    <?php
    if (isset($_GET['label'])) {

        $originalLabel = $_GET['originalLabel'];

        $label = $_GET['label'];
        $type = $_GET['type'];

        echo 'You entered: ' . $label . ' and ' . $type .'<br>';

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "websoft";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully <br>";

        $sql = "
UPDATE tech 
SET label='" . $label ."', type='" . $type . "' 
WHERE label='" . $originalLabel . "'";

        if ($conn->query($sql) === TRUE) {
            echo "Updated value successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

    }

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
