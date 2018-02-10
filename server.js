var express    = require("express");
 var mysql      = require('mysql');
 var configDB = require('./config/database.js');
 var connection = mysql.createConnection(configDB);
 var app = express();
 
 connection.connect(function(err){
 if(!!err) {
     console.log("Database is connected ... \n\n");  
 } else {
     console.log("Error connecting database ... \n\n");  
 }
 });

app.listen(3000);