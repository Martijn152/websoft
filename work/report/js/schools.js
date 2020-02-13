/**
 * A function to wrap it all in.
 */
(function () {

    const selection = document.getElementById('municipalities');
    selection.addEventListener('change', function () {
        var selected = selection.options[selection.selectedIndex].text;
        console.log(selected);
        const table = document.getElementById('table');
        table.innerHTML='';
        const url = 'schools-'+selected+'.json';

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
                data.Skolenheter.forEach(function (element) {
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

    });

    //Getting data to fill the select options
    fetch('municipalities.json')
        .then((data) => data.json())
        .then(function (data) {

            data = JSON.stringify(data);
            data = JSON.parse(data);
            console.log(data);

            data.Kommuner.forEach(function (element) {
                //I only want a few, in this case 4
                if(element.Kommunkod >= 1280 && element.Kommunkod <= 1283){
                    var option = document.createElement('option');
                    option.append(document.createTextNode(element.Namn));
                    selection.append(option);
                }
            })
        });
}());







