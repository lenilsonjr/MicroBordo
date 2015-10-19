<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');
?>

<div class="row">
    <h2 class="page-header text-center">
        Opções
    </h2>
</div>

<form id="optionsForm">

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">Nome do seu negócio:</h3>
                </div>

                <div class="panel-body">
                    <input class="form-control" type="text" name="name" value="<?php echo GrafDesk::getBusinessName(); ?>" placeholder="Nome do seu negócio...">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">Endereço do seu negócio:</h3>
                </div>

                <div class="panel-body">
                    <textarea name="address" class="form-control" placeholder="Endereço..." rows="3" cols="20"></textarea>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">Telefones para contato:</h3>
                </div>

                <div class="panel-body">
                    <textarea name="phones" class="form-control" placeholder="Telefones..." rows="3" cols="20"></textarea>
                </div>
            </div>
        </div>

        <div class="col-md-12">

            <button class="btn btn-success btn-raised pull-right">Atualizar</button>

        </div>

    </div>


</form>
<script type="text/javascript">
    $("#optionsForm").submit(function(){

        $.ajax({
            url: 'core/ajax.php?action=updateOptions',
            data: $("#optionsForm").serialize(),
            type: 'POST',
            timeout: 60000,
            success: function(response){

                response = eval(response);
                alertMessage(response[0], response[1]);

            },
            error: function(erro){

                alertMessage(1, "<h2 class=\"text-danger\">Erro de comunicação com o servidor!</h2>");

            }
        });

        return false;

    });
</script>
<br />
<?php echo GrafDesk::getContent('list-users'); ?>
