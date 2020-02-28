<?php
include 'view/docStart.php';
include 'view/header.php';
?>

<article>

    <h1>Search</h1>

    <form>

        <input type="text" name="searchTerm">
        <input type="submit" value="Search">


    </form>
    <br>

    <table>
        <?php
        if (isset($_GET['searchTerm'])) {
            $searchTerm = $_GET['searchTerm'];
            echo 'Your search term is: ' . $searchTerm . '<br>';

            include 'dbdata.php';

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM tech WHERE label LIKE '%" . $searchTerm . "%' OR type LIKE '%" . $searchTerm . "%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "Found the following results: <br><br>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td><td>" . $row["label"] . "</td><td>" . $row["type"] . "</td>";
                    echo "</tr>";

                }
            } else {
                echo "0 results";
            }
            $conn->close();

        }

        ?>
    </table>

</article>

<?php
include 'view/footer.php';
include 'view/docEnd.php';
?>
