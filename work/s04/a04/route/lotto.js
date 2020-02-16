/**
 * Route for today.
 */
"use strict";

var express = require("express");
var router = express.Router();
let data = {numbers: [17, 32, 8, 12, 24, 18, 19]};

router.get("/", (req, res) => {
    if (typeof req.query.row !== 'undefined') {
        let queryArray = req.query.row.replace('row=','');
        queryArray = queryArray.split(',');

        let amountCorrect = 0;

        for (var i = 0; i < data.numbers.length; i++) {
            for (var j = 0; j < queryArray.length; j++) {
                if (data.numbers[i].toString() === queryArray[j]) {
                   amountCorrect++;
                }
            }
        }
        res.render("lotto", {
            correct: amountCorrect,
            numbers: data.numbers,
            userNumbers: queryArray
        });
    } else {
        res.render("lotto", {
            correct: "not applicable",
            numbers: data.numbers,
            userNumbers: ['','','','','','','']
        });
    }

});


module.exports = router;