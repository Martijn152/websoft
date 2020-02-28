<?php
include 'view/docStart.php';
include 'view/header.php';
?>

<article>

    <h1>Delete an existing row</h1>

    <form action="/php/delete.php" method="get">


        <input type="text" name="label" placeholder="label of row to delete"
            <?php
            if (isset($_GET['selected'])) {
                echo "value='" . $_GET['selected'] . "'";
            }
            ?>
        >

        <input type="submit" value="Submit"><br>

    </form>

    <?php
    if (isset($_GET['label'])) {

        $label = $_GET['label'];

        echo 'You entered: ' . $label . '<br>';

        include 'dbdata.php';

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully <br>";

        $sql = "
DELETE FROM tech  
WHERE label='" . $label . "'";

        if ($conn->query($sql) === TRUE) {
            echo "Deleted row successfully";
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