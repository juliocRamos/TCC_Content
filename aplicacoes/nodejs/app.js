var express = require('express');
var app = express();
app.set('view engine', 'ejs');
app.use(express.static("public"));
var alunoController = require('./controllers/alunoController');
var disciplinaController = require('./controllers/disciplinaController');
var fibonacciController = require('./controllers/fibonacciController');
var cluster = require('cluster');
const numCPUs = require('os').cpus().length;


if (cluster.isMaster) {
  for (var i = 0; i < numCPUs; i++) {
      console.log("Paralelizado no núcleo "+i);
      cluster.fork();
  }

  cluster.on('exit', (worker, code, signal) => {
    console.log(`worker ${worker.process.pid} died`);
    console.log('Starting new process.....Since a worker died');
    cluster.fork();//new process.
  });

} else {
     
  app.get('/', function(req, resp){
    resp.render('home');
  });

  //rotas aluno
  alunoController(app);

  //rotas disciplina
  disciplinaController(app);

  //rotas fibonacci
  fibonacciController(app);
  
  //porta em que o servidor esta trabalhando
  app.listen(3000);
  
}
