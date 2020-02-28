/**
 * A function to wrap it all in.
 */
(function () {

    duckieSetup()
}());

function duckieSetup() {
    var duckieCounter = 0;
    var counterElement = document.getElementById('counterElement');


    //Creating duckie and some of its variables
    var duckie = {
        image: 'img/duck.jpg',
        position: {x: 10, y: 10},
        HTMLelement: document.getElementById('duck')
    };

    //Creating move function
    duckie.move = function (x, y) {
        this.position.x = x;
        this.position.y = y;
    };

    //Creating draw function
    duckie.draw = function () {
        this.HTMLelement.style.backgroundImage = 'url(' + this.image + ')';
        this.HTMLelement.style.top = this.position.y + 'px';
        this.HTMLelement.style.left = this.position.x + 'px';
    };

    //Drawing duckie for the first time
    duckie.draw();

    //Adding onclick listener so it moves when clicked
    duckie.HTMLelement.addEventListener('click', function (event) {
        //console.log('Clicked on: ' + event.clientX + ' x ' + event.clientY);
        duckie.move(Math.random() * 1000, Math.random() * 500);
        duckie.draw();
        duckieCounter += 1;
        counterElement.innerHTML = '';
        counterElement.append(document.createTextNode("Duckies caught: " + duckieCounter));
    });

    //Creating the timer to hide and show the duckie
    var round = 1;
    window.setInterval(function () {
        if (round === 1) {
            duckie.HTMLelement.style.visibility = "visible";
            round = 0;
        } else {
            duckie.HTMLelement.style.visibility = "hidden";
            round = 1;
        }
    }, 3000);

}
	
