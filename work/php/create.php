<?php
include 'view/docStart.php';
include 'view/header.php';
?>

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

        echo 'You entered: ' . $label . ' and ' . $type . '<br>';

        include 'dbdata.php';

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully <br>";

        $sql = "
INSERT INTO tech (label, type)
VALUES ('" . $label . "', '" . $type . "')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

    }

    ?>
</article>

<?php
include 'view/footer.php';
include 'view/docEnd.php';
?>
