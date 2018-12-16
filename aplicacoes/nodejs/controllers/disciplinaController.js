module.exports = function(app){
var config = require('../db/knexfile');
var env = 'mysql';
var knex = require('knex')(config[env]);
var bodyParser = require('body-parser');
var urlcodedParser = bodyParser.urlencoded({extended:false});


    //rotas de views
    app.get('/disciplina/index', function(req, resp){
        resp.render('disciplina/index');
    });

    app.get('/disciplina/listar', function(req, resp){
        resp.render('disciplina/list-disciplinas');
    });
    //fim rotas de views

//rotas de crud
    //cria uma disciplina
    app.post('/disciplina/create', urlcodedParser, function(req, resp){
        knex.insert(req.body).into("disciplinas").then(function () {     
            var result='success';
            resp.json(result);
        })
    });

    app.get('/disciplina/getAll', urlcodedParser, function(req, resp){
        knex.select().from("disciplinas").then(function(data){
            resp.json(data);
        });
    });

    app.post('/disciplina/getDisciplina', urlcodedParser, function(req, resp){
        knex('disciplinas').where('id',req.body.id).first().then(function(data){
            resp.json(data);
        });
    });

    app.post('/disciplina/destroy', urlcodedParser, function(req, resp){
        knex('disciplinas').where('id', req.body.id).del().then(function(){
            var result = 'success';
            resp.json(result);
        })
    });

    app.post('/disciplina/update', urlcodedParser, function(req, resp){
        knex('disciplinas').where('id', req.body.id).first().update(req.body).then(function(){
            var result = 'success';
            resp.json(result);
        });
    });
    //fim rodas te crud
   
};