/**
 * Route for today.
 */
"use strict";

var express = require("express");
var router = express.Router();
let data = {numbers: [17, 32, 8, 12, 24, 18, 19]};

router.get("/", (req, res) => {
    if (typeof req.query.row !== 'undefined') {
        let queryArray = req.query.row.substring('row='.length);
        queryArray = queryArray.split(',');

        let correctData = [];

        for (var i = 0; i < data.numbers.length; i++) {
            for (var j = 0; j < queryArray.length; j++) {
                if (data.numbers[i].toString() === queryArray[j]) {
                    correctData.push(data.numbers[i]);
                }
            }
        }
        res.send({
            correct: correctData.length,
            numbers: correctData
        });
    } else {
        res.send(data);
    }

});

module.exports = router;