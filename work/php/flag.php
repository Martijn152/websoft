<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>About this site</title>
    <link rel="stylesheet" href="css/flags.css">
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

    <h1>Flags</h1>
    <p>
        <canvas id='canvas1' width="100px" height="90px"></canvas>
        <canvas id='canvas2' width="100px" height="90px"></canvas>
        <canvas id='canvas3' width="100px" height="90px"></canvas>
    </p>

    <a id='buttonNetherlands'>The Netherlands</a>
    <a id='buttonIreland'>Ireland</a>
    <a id='buttonGreece'>Greece</a>

</article>

<footer>
    <?php
    include 'view/footer.php';
    ?>
</footer>

<script type="text/javascript" src="js/flags.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
