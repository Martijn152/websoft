<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create page</title>
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

    <h1>Create a new row</h1>

    <form action="/php/create.php" method="get">

        <input type="text" name="label" placeholder="label">
        <input type="text" name="type" placeholder="type">

        <input type="submit" value="Submit"><br>

    </form>

    <?php
    if (isset($_GET['label'])) {

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
INSERT INTO tech (label, type)
VALUES ('" . $label ."', '" . $type . "')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
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
