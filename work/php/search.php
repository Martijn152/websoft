<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search page</title>
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

    <h1>Search</h1>

    <form action="/php/search.php" method="get">

        <input type="text" name="searchTerm"><br>

        <input type="submit" value="Submit"><br>

    </form>

    <?php
    if (isset($_GET['searchTerm'])) {
        $searchTerm = $_GET['searchTerm'];
        echo 'Your search term is: ' . $searchTerm . '<br>';

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

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["label"]. " " . $row["type"]. "<br>";
            }
        } else {
            echo "0 results";
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
