<!DOCTYPE html>
<html lang="pt-br" >
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/assets/css/bootstrap.css">
        <script type="text/javascript" src="/assets/js/jquery-3.3.0.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color:white; background:#F35045;" href="{{ url('home')}}">Home</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                
                    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fibonacci<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li >{{Html::link('/fibonacci/index', 'Sequência Fibonacci')}} <span class="sr-only"></span></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Aluno<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li >{{Html::link('/aluno/index', 'Cadastro de alunos')}} <span class="sr-only"></span></li>
                                <li>{{Html::link('/aluno/listar', 'Listar de alunos')}}</li>
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Disciplinas<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>{{Html::link('disciplina/index', 'Cadastro de disciplinas')}}</li>
                                <li>{{Html::link('disciplina/listar', 'Listar de disciplinas')}}</li>
                            </ul>
                        </li>
                    </ul> 
                            
                </ul>

                    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Testes de benchmark<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><img src="/assets/imgs/laravel_logo.png" style="width:40px; height:40px;" ></img>Testes em Laravel</a></li>
                                <li><a href="#"><img src="/assets/imgs/asp_net_logo.png" style="width:40px; height:40px;" >Testes em Asp.Net</a></li>
                                <li><a href="#"><img src="/assets/imgs/nodejs_logo.png" style="width:40px; height:40px;" >Testes em NodeJs</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container">
        
            @yield('content')
            
        </div>    

        
    </body>
    





</html>