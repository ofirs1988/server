var express = require('express');
var mysql = require('mysql');
var app = express();
var connection = mysql.createPool({
   connectionLimit : 50,
   host : '127.0.0.1',
   user : 'root',
   password : 'dd429glkk',
   database : 'site'
});

app.use('/parse', function(req, res, next) {
    // Do PRE work
    next();
    // Do POST work
});

app.get('/', function(req, res){
    connection.getConnection(function (error,tempCont) {
        if(!!error){
            console.log('Connection Error')
        }else {
            console.log('connected!')
            tempCont.query('SELECT * FROM wt_users',function (error,rows,fields) {
                tempCont.release();
                if(!!error){
                    console.log('Error in query');
                }else{
                    console.log('succsess')
                    res.json(rows);
                }
            })
        }
    })
});

app.listen(1337);