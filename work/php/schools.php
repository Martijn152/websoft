<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Schools page</title>
    <link rel="stylesheet" href="css/schools.css">
</head>

<body>

<div id='duck' style="height: 100px; width: 100px; position: absolute"></div>


<header>
    <?php
    include 'view/header.php';
    ?>
</header>


<article>
    <h1>Schools</h1>
    <label for="municipalities">Select a municipality</label><select id="municipalities"></select>
    <p></p>
    <table id="table"></table>


</article>


<footer>
    <?php
    include 'view/footer.php';
    ?>
</footer>


<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/schools.js"></script>

</body>
</html>
