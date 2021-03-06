@extends('templates.menu')
@section('content')

<div class = "container" >
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Sequência de Fibonacci</h2>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-8">
    
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <form method="POST" action="#" accept-charset="UTF-8">
                        <label for="nome">Results Fibonacci</label>
                        <textarea style = "resize:none" class="form-control" rows = "11" col = "70" placeholder="Série de Fibonacci" name="fibo" type="textarea" id="fibonacci"></textarea>
                    </form>
                    <!-- <button class="btn btn-success" onclick="generateSequence()" type="button">Cadastrar</button>
                    <button class="btn btn-danger" type="reset" onclick = "clearTextArea()">Cancelar</button>      -->
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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
<script src="/assets/js/jquery.min.js" type="text/javascript"></script>
<script>

    //Função para salvar os dados do aluno
    $( document ).ready(function() {
        alert( "A requisição do fibonacci pode demorar um pouco. Tenha paciência :)");
        generateSequence();
    });
    function generateSequence(){ 
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            } ,
            type: 'get',
            url: '{{ url('fibonacci/fibonacciRecursive') }}',
            dataType: "json",
            async: true,
            success:function(data){
                $("#fibonacci").val(data)
            },
            error:function(xhr, ajaxOptions, thrownError){
                alert('Erro: ' + xhr.error + ' --> ' + thrownError);        
            },
        });
    }

    function clearTextArea() {
        $("#fibonacci").val("");
    }
</script>