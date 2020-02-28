<?php
include 'view/docStart.php';
include 'view/header.php';
?>


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

        echo 'You entered: ' . $label . ' and ' . $type . '<br>';

        include 'dbdata.php';

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully <br>";

        $sql = "
UPDATE tech 
SET label='" . $label . "', type='" . $type . "' 
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

<?php
include 'view/footer.php';
include 'view/docEnd.php';
?>
