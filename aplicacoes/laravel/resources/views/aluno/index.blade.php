@extends('templates.menu')
@section('content')

<div class = "container" >
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Cadastro de alunos</h2>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-8">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <form method="POST" action="#" accept-charset="UTF-8">
                        <label for="nome">Nome</label>
                        <input class="form-control" placeholder="Nome" name="nome" type="text" id="nome">
                        <label for="email">E-mail</label>
                        <input class="form-control" placeholder="E-mail" name="email" type="email" id="email">
                        <label for="idade">Idade</label>
                        <input class="form-control" placeholder="Idade" name="idade" type="number" id="idade">
                                
                        <label for="sexo">Sexo</label>
                        <select id="sexo" class="form-control" name="sexo">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                        <hr>  
                        <button class="btn btn-success" onclick="salvarDados()" type="button">Cadastrar</button>
                        <button class="btn btn-danger" type="reset">Cancelar</button>
                    </form>     
                </div>
                        
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Used software
                            </h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li>Developed in: Windows 10 and Fedora 25</li>
                                <li>Works with Bootstrap's native form examples</li>
                                <li>Server version: Apache/2.4.25</li>
                                <li>Server built: Dec 22 2016 15:21:24</li>
                                <li>MariaDB 10.1 database server</li>
                                <hr>
                                <p>github: <a href="https://github.com/juliocRamos">Júlio César Ramos</a></p>
                                <p>github: <a href="https://github.com/RodrikKlesse">Rodrik Klesse</a></p>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

<script>

    //Função para salvar os dados do aluno
    function salvarDados(){ 
        var nome = $('#nome').val();
        var email = $('#email').val();
        var idade = $('#idade').val();
        var sexo = $('#sexo').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            } ,
            type: 'post',
            url: '{{ url('aluno/cadastrar') }}',
            dataType: "json",
            async: true,
            data:{'nome':nome,
                'email':email,
                'idade':idade,
                'sexo':sexo,
            },
            success:function(data){
                alert(data);
            },
            error:function(xhr, ajaxOptions, thrownError){
                alert('Erro: ' + xhr.error + ' --> ' + thrownError);        
            },
        });
    }
</script>