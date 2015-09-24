<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');
?>
<form id="NewCategory">

    <div class="row">
        <h2 class="page-header text-center">
            Cadastrar nova categoria
        </h2>
    </div>

    <div class="row">

        <div class="row">
            <button type="submit" class="btn btn-lg btn-success pull-right btn-cad">Cadastrar</button>
        </div>
        <div class="row">
            <?php echo MicroBordo::getContent('form-category'); ?>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-lg btn-success pull-right btn-cad">Cadastrar</button>
        </div>

    </div>
</form>
<script type="text/javascript">

$("#NewCategory").submit(function(){

    $.ajax({
        url: 'core/ajax.php?action=newProductCategory',
        data: $("#NewCategory").serialize(),
        type: 'POST',
        timeout: 60000,
        success: function(response){

            response = eval(response);

            if (response[0] == 0) {

                alertMessage(0, response[1]);
                $("#NewCategory").find("input[type=text], textarea").val("");

            } else {

                alertMessage(1, response[1]);

            }
        },
        error: function(erro){

            alertMessage(1, 'Ocorreu um erro de comunicação com o servidor.');

        }
    });

    return false;
});
</script>
