/**
 * A function to wrap it all in.
 */
(function () {
    "use strict";
    fillTable();

}());

function fillTable() {

    const table = document.getElementById('table');
    const url = 'schools.json';

    fetch(url)
        .then((data) => data.json())
        .then(function (data) {

            //Prepping the data for use
            data = JSON.stringify(data);
            data = JSON.parse(data);

            //Creating the column names
            var keys = Object.keys(data.Skolenheter[0]);
            var thead = table.createTHead();
            var headRow = thead.insertRow();
            keys.forEach(function (key) {
                var th = document.createElement("th");
                var text = document.createTextNode(key);
                th.appendChild(text);
                headRow.appendChild(th);
            });

            //Logging length of the data set
            console.log("Columns in Skolenheter: " + data.Skolenheter.length);

            //Add new row for each school
            data.Skolenheter.forEach(function(element){
               var row = table.insertRow();

               //Get keys to be able to iterate through the elements for the row
               var elementKeys = Object.keys(element);

               //Add new cell for each element in the row
               elementKeys.forEach(function (elementCell) {
                   var cell = row.insertCell();
                   cell.append(document.createTextNode(element[elementCell]));
               });
            });


        })
        .catch(function (error) {
            console.log(error);
        });


}

	
