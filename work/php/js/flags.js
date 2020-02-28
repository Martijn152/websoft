/**
 * A function to wrap it all in.
 */
(function () {

    var canvas1 = document.getElementById("canvas1");
    var ctx1 = canvas1.getContext("2d");
    var canvas2 = document.getElementById("canvas2");
    var ctx2 = canvas2.getContext("2d");
    var canvas3 = document.getElementById("canvas3");
    var ctx3 = canvas3.getContext("2d");




    document.getElementById("buttonNetherlands").addEventListener('click', function (event) {
        drawNetherlands(ctx1);
    });
    document.getElementById("buttonIreland").addEventListener('click', function (event) {
        drawIreland(ctx2);
    });
    document.getElementById("buttonGreece").addEventListener('click', function (event) {
        drawGreece(ctx3);
    });




    canvas1.addEventListener('click',function () {
        canvas1.style.opacity= "0";
    });
    canvas2.addEventListener('click',function () {
        canvas2.style.opacity= "0";
    });
    canvas3.addEventListener('click',function () {
        canvas3.style.opacity= "0";
    });

}());

function drawNetherlands(ctx) {
    ctx.fillStyle = "red";
    ctx.fillRect(0, 0, 100, 30);
    ctx.fillStyle = "white";
    ctx.fillRect(0, 30, 100, 30);
    ctx.fillStyle = "blue";
    ctx.fillRect(0, 60, 100, 30);
}

function drawIreland(ctx) {
    ctx.fillStyle = "green";
    ctx.fillRect(0, 0, 33, 90);
    ctx.fillStyle = "white";
    ctx.fillRect(33, 0, 33, 90);
    ctx.fillStyle = "orange";
    ctx.fillRect(66, 0, 34, 90);
}

function drawGreece(ctx) {
    ctx.fillStyle = "blue";
    ctx.fillRect(0, 0, 20, 20);
    ctx.fillRect(30, 0, 20, 20);
    ctx.fillRect(0, 30, 20, 20);
    ctx.fillRect(30, 30, 20, 20);

    ctx.fillRect(50,0,50,10);
    ctx.fillRect(50,20,50,10);
    ctx.fillRect(50,40,50,10);
    ctx.fillRect(0,60,100,10);
    ctx.fillRect(0,80,100,10);
}

