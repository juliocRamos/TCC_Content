@extends('templates.menu')
@section('content')

<div class ="container">  
    <div class="panel panel-default">
        <div class="panel-heading">
            <center><h2>Lisda de disciplinas</h2></center>
        </div> 
    </div>

    <div class="row">              
        <table  id="myDatatable" class = "table table-striped">
            <tr>
                <thead>
                    <th>Ações</th>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Professor</th>
                    <th>Duração</th>
                    <th>Descrição</th>
                    <th>Pedíodo</th>
                    </thead>    
            </tr>
            <tbody id="tabela">

		    </tbody>
        </table>
        
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alterar dados</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="" accept-charset="UTF-8"><input name="_token" type="hidden" value="fnhLmqysGtwXrrureJdIQP2TNEeLcCsgJJDf2beR">     
                    <label for="id">Id</label>
                    <input class="form-control" class="id" name="id" type="text" id="id" disabled>
                    <label for="nome">Nome</label>
                    <input class="form-control" placeholder="Ex. Pesquisa Operacional" name="nome" type="text" id="nome">
                    <label for="duracao">Carga horaria</label>
                    <input class="form-control" placeholder="Carga horaria da disciplina" name="duracao" type="number" id="duracao">
                            
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" placeholder="Descreva aqui os tópicos abordados na disciplina" rows="3" style="resize:none" name="descricao" cols="50" id="descricao"></textarea>
                            
                    <div class="form-group float-label-control">
                        <div class="form-group">    
                            <label for="professor">Ministrador</label>
                            <select class="form-control" required id="professor" name="professor"><option value="Diego Fiori">D.Fiori</option><option value="Binho">Binho</option>
                            <option value="Sérgio">Sérgio</option><option value="Juninho">Juninho</option></select>     
                        </div> 
                    </div>            
                    <label for="periodo">Periodo</label>
                    <div class="form-group float-label-control">
                        <input name="periodoM" type="checkbox" value="Matutino" id="periodo">
                        <label for="p-matutino">Matutino</label>
                            
                        <input name="periodoI" type="checkbox" value="Integral" id="periodo">
                        <label for="p-integral">Integral</label>

                        <input name="periodoF" type="checkbox" value="Noturno" id="periodo">
                        <label for="p-noturno">Noturno</label>
                    </div>  
                    <hr>  
                </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="atualizarDisciplina()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</div>
@stop

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
<script>
    $(document).ready(function(){//script para listar alunos
        $.ajax({
            type:'get',
            url:'{{url('disciplinas-getall')}}',
            async: true,
            success: function(disciplina){
                for(var i=0;disciplina.length>i;i++){
                    $('#tabela').append('<tr class = "row-fadeout"><td><button class = "getDados" data-toggle="modal" data-target="#myModal">Alterar</button><button class="deletar">Excluir</button></td><td class="id">'
                    +disciplina[i].id+'</td><td>'+disciplina[i].nome+'</td><td>'+disciplina[i].professor+'</td><td>'+disciplina[i].duracao+
                    '</td><td>'+disciplina[i].descricao+'</td><td>'+disciplina[i].periodo+'</td></tr>');
			    }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Erro na requisição: '+xhr.status+' --> '+thrownError);
            },

            });
        });   
</script>



<script>
    //novo script para deletar
    $(document).on("click", ".deletar", function(){
        var row = $(this).closest('tr');
        var valor = $(this).parent().parent().find('.id');
        var id = valor.html();
        var token = $('#token').val();
        $.ajax({
            type: 'get',
            async: true,
            url: '{{url('excluir-disciplina')}}',
            data: {
                'id':id,
                'token':token,
            },
            success: function(data){
                if(data == "success"){
                    alert("Dados deletados!!");
                    row.fadeOut();
                }
                else{
                    alert(data);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Erro: '+xhr.status+' --> '+thrownError);
            },
        });
    });
        

</script>



<script>
    //novo script para pegar os dados da disciplina da linha clicada
     $(document).on("click", ".getDados", function(){
        var valor = $(this).parent().parent().find('.id');
        var id = valor.html();
        var token = $('#token').val();
        $.ajax({
            type: 'get',
            async: true,
            url: '{{url('disciplina-get-dados')}}',
            data: {
                'id':id,
                'token':token,
            },
            success: function(data){
                $("#id").val(data.id);
                $("#nome").val(data.nome);
                $("#duracao").val(data.duracao);
                $("#descricao").val(data.descricao);
                $("#professor").val(data.professor);
                if(data.periodo == "MATUTINO"){
                    $("input[name='periodoM']").attr('checked', true);
                }
                else if(data.periodo == "INTEGRAL"){
                    $("input[name='periodoI']").attr('checked', true);
                }
                if(data.periodo == "NOTURNO"){
                    $("input[name='periodoN']").attr('checked', true);
                }    
            
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Erro: '+xhr.status+' --> '+thrownError);
            },
        });
    });

    function atualizarDisciplina(){ 
        var id = $('#id').val();
        var nome = $('#nome').val();
        var duracao = $('#duracao').val();
        var descricao = $('#descricao').val();
        var professor = $('#professor').val();
        var periodo = $('#periodo').val();
        var token = $('#token').val();
        $.ajax({
            type: 'get',
            url: '{{url('atualizar-disciplina')}}',
            async: true,
            data: {
                'id':id,
                'nome': nome,
                'duracao': duracao,
                'descricao': descricao,
                'professor': professor,
                'periodo':periodo,
                'token':token,
            },
            success: function(data){
                if(data == "success"){
                    alert('Dados da disciplina foram alterados!!');
                    location.reload();
                }
                else{
                    alert('Erro ao atualizar dados!!');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Erro: ' + xhr.status + ' --> ' + thrownError);
            },
        });
    }

</script>


