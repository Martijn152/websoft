<?php
include 'view/docStart.php';
include 'view/header.php';
?>



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

<script type="text/javascript" src="js/flags.js"></script>

<?php
include 'view/footer.php';
include 'view/docEnd.php';
?>
