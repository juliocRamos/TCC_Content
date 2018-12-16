@extends('templates.menu')
@section('content')

<div class = "container">
    <div class="panel panel-default">
            <div class="panel-heading">
                <center><h2>Lista de alunos</h2></center>
            </div> 
    </div>
    <div class="row">
        <table id="myDatatable" class = "table table-striped">
            <tr>
                <thead>
                    <th>Ações</th>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Idade</th>
                    <th>Sexo</th> 
                </thead>    
            </tr>
            <tbody id="tabela">
                        
            </tbody>
        </table>
    </div>

    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alteração de Dados</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="" accept-charset="UTF-8"><input type="hidden" value="fnhLmqysGtwXrrureJdIQP2TNEeLcCsgJJDf2beR">  
                
                    <label for="id">Id</label>
                    <input class="form-control" name="id" type="text" id="id" disabled>
                    
                    <label for="nome">Nome</label>
                    <input class="form-control" placeholder="Nome" name="nome" type="text" id="nome">
                    
                    <label for="email">E-mail</label>
                    <input class="form-control" placeholder="E-mail" name="email" type="email" id="email">
                    
                    <label for="idade">Idade</label>
                    <input class="form-control" placeholder="Idade" name="idade" type="number" id="idade">
                                 
                    <div id="form-control">   
                        <input type='checkbox' id='sexo' name='sexoM' value='Masculino' />
                        <label for="sexoM">Masculino</label>
                        <input type='checkbox' id='sexo' name='sexoF' value='Feminino' />
                        <label for="sexoF">Feminino</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="atualizarAluno()">Salvar Alterações</button>
            </div>
        </div>
    </div>
</div>
@stop
<script type="text/javascript" src="/public/js/jquery-3.3.0.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 
<script>
    //script para listar alunos
    $(document).ready(function () {
        var token = $('#token').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'GET',
            url:'{{ url('aluno/getall') }}',
            async: true,
            success: function(aluno){
                for(var i=0;aluno.length>i;i++){
                    $('#tabela').append('<tr class = "row-fadeout"><td><button class="getDados" data-toggle="modal" data-target="#myModal">Alterar</button><button class="deletar">Excluir</button></td><td class="id"> ' 
                        + aluno[i].id + ' </td><td> ' + aluno[i].nome + ' </td><td> ' + aluno[i].email + ' </td><td> ' + aluno[i].idade + 
                        ' </td><td> ' + aluno[i].sexo + ' </td></tr>');
			    }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Erro na requisição: ' + xhr.status + ' --> ' + thrownError);
            },

        });
   
    });
</script>
<script>
    //script para deletar
    $(document).on("click", ".deletar", function(){
        var row = $(this).closest('tr');
        var valor = $(this).parent().parent().find('.id');
        var id = valor.html();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            async: true,
            url: '{{ url('aluno/excluir') }}',
            data: {
                '_id':id,
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

    $(document).on("click", ".getDados", function(){
        var valor = $(this).parent().parent().find('.id');
        var id = valor.html();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: 'POST',
            async: true,
            url: '{{ url('aluno/editar')}}',
            data: {
                '_id':id,
            },
            success: function(data){
                $("#id").val(data.id);
                $("#nome").val(data.nome);
                $("#email").val(data.email);
                $("#idade").val(data.idade);
                if(data.sexo == "MASCULINO"){
                    $("input[name='sexoM']").attr('checked', true);
                }
                else{
                    $("input[name='sexoF']").attr('checked', true);
                }    
            
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Erro: '+xhr.status+' --> '+thrownError);
            },
        });
    });


//Função para envia-los ao banco
    function atualizarAluno(){ 
        var id = $('#id').val();
        var nome = $('#nome').val();
        var email = $('#email').val();
        var idade = $('#idade').val();
        if($("input[name='sexoM']").is(':checked')){
            var sexo = 'Masculino';
        }
        else{
            var sexo = 'Feminino';
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: 'POST',
            url: '{{ url('aluno/atualizar') }}',
            async: true,
            data: {
                '_id':id,
                'nome': nome,
                'email': email,
                'idade': idade,
                'sexo': sexo,
            },
            success: function(data){
                if(data == "success"){
                    alert('Dados do aluno foram alterados!!');
                    location.reload();
                }
                else{
                    alert('Erro ao atualizar os dados');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert('Erro: ' + xhr.status + ' --> ' + thrownError);
            },
        });
    }

</script>

