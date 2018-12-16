
@extends('templates.menu')
@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Cadastro de disciplina</h2>
             <p id = "lista-disciplinas"></p>
        </div>
    
        <div class ="panel-body">
        
        <div class="row">
            <div class="col-sm-8">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <form method="POST" action="http://127.0.0.1:8000/cadastrar-disciplina" accept-charset="UTF-8"><input name="_token" type="hidden" value="fnhLmqysGtwXrrureJdIQP2TNEeLcCsgJJDf2beR">
                               
                    <label for="nome">Nome</label>
                    <input class="form-control" placeholder="Ex. Pesquisa Operacional" name="nome" type="text" id="nome" autofocus>
                    <label for="duracao">Carga horaria</label>
                    <input class="form-control" placeholder="Carga horaria da disciplina" name="duracao" type="number" id="duracao">
                    
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" placeholder="Descreva aqui os tópicos abordados na disciplina" rows="3" style="resize:none" name="descricao" cols="50" id="descricao"></textarea>
                    
                    <div class="form-group float-label-control">
                        <div class="form-group">    
                            <label for="professor">Ministrador</label>
                            <select class="form-control" required id="professor" name="professor"><option value="Diego Fiori">D.Fiori</option><option value="Jhon Rubens">Binho</option><option value="Sérgio">Sérgião Berranteiro</option></select>     
                        </div> 
                    </div>            
                    <label for="periodo">Periodo</label>
                    <div class="form-group float-label-control">

                        <input name="periodo" type="checkbox" value="Matutino" id="periodo">
                        <label for="periodo">Matutino</label>
                    
                        <input name="periodo" type="checkbox" value="Integral" id="periodo">
                        <label for="periodo">Integral</label>

                        <input name="periodo" type="checkbox" value="Noturno" id="periodo">
                        <label for="periodo">Noturno</label>

                    </div>  
                    <hr>  
                    <button class="btn btn-success" onclick="salvarDados()" type="button">Cadastrar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                </form>     
            </div>                
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Used Software
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
                            <p>github:<a href="https://github.com/juliocRamos">Júlio César Ramos</a></p>
                            <p>github:<a href="https://github.com/RodrikKlesse">Rodrik Klesse</a></p>
                        </ul>
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
        var duracao = $('#duracao').val();
        var descricao = $('#descricao').val();
        var professor = $('#professor').val();
        var periodo = $('#periodo').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            } ,
            type: 'post',
            url: '{{ url('cadastrar-disciplina') }}',
            async: true,
            data: {
                'nome': nome,
                'duracao': duracao,
                'descricao': descricao,
                'professor': professor,
                'periodo':periodo,
            },
            success: function(data){
                alert(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Erro: ' + xhr.status + ' --> ' + thrownError);
            },
        });
    }
</script>