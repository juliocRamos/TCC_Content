module.exports = function(app){
var bodyParser = require('body-parser');
var urlcodedParser = bodyParser.urlencoded({extended:false});


    //rotas de views
    app.get('/fibonacci/index', function(req, resp){
        resp.render('fibonacci/index');
    });

    app.get('/fibonacci/generateRecursive', urlcodedParser, function(req, resp){
        var fib = [];
        for (i = 0; i <= 46; i++) {
            fib[i] = fibonacci(i);
        }
        resp.json(fib);
    });

    function fibonacci(num)
    {
        if (num <= 1) {
            return 1;
        }
        return fibonacci(num -1) + fibonacci(num - 2);
    }
}