module.exports = function(app){
var config = require('../db/knexfile');
var env = 'mysql';
var knex = require('knex')(config[env]);
var bodyParser = require('body-parser');
var urlcodedParser = bodyParser.urlencoded({extended:false});

// rotas para implementar as views
    app.get('/aluno/index', function(req, resp){
        resp.render('aluno/index');
    });

    app.get('/aluno/listar', function(req, resp){
        resp.render('aluno/list-alunos');
    });
//fim rotas para views


//rotas de crud
    //cria aluno
    app.post('/aluno/create', urlcodedParser, function(req, resp){
        knex.insert(req.body).into("alunos").then(function () {
            var result = 'success';
            resp.json(result);
        });
    });
    //retorna todos os alunos
    app.get('/aluno/getAll', function(req, resp){
        knex('alunos').select().then(function(data){
            resp.json(data);
        });
    });

    //retorna um aluno especificado pelo ID
    app.post('/aluno/getAluno', urlcodedParser, function(req, resp){
        knex('alunos').where('id', req.body.id).first().then(function(data){
            resp.json(data);
        });
    });

    //atualiza os dados do aluno especificado pelo ID
    app.post('/aluno/update', urlcodedParser,function(req, resp){
        knex('alunos').where('id', req.body.id).first().update(req.body).then(function(){
            var data = 'success';
            resp.json(data);
        });
    });

    //deleta um aluno da base de dados
    app.post('/aluno/destroy', urlcodedParser, function(req, resp){
        knex('alunos').where('id', req.body.id).del().then(function(){
            var msg = 'success';
            resp.json(msg);
        })
    });
//fim rotas de crud
};