<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');
?>
<!-- Modal para adicionar categorias -->
<div class="modal fade" id="modalNewCategory" tabindex="-1" role="dialog" aria-labelledby="modalNewCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nova Categoria</h4>
            </div>
            <div class="modal-body">

                <div class="row">

                    <form id="formNewCategory" name="formNewCategory" style="padding: 10px;">

                        <?php MicroBordo::getContent('form-category'); ?>

                    </form>

                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="btn-add-category" form="formNewCategory">Salvar</button>
                <button type="button" class="btn btn-default" id="btn-cancel-new-category" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$("#modalNewCategory").on('hide.bs.modal', function (event){

    $("#modalNewCategory").find(".modalMsg").empty();
    $("#modalNewCategory").find("input[name=\"name\"]").val('');

});

$("#formNewCategory").submit(function(){

    $.ajax({

        url: 'core/ajax.php?action=newProductCategory',
        data: $("#formNewCategory").serialize(),
        type: 'POST',
        timeout: 60000,
        success: function(response){

            response = eval(response);
            $("#modalNewCategory").find(".modalMsg").empty();

            if (response[0] == 0) {

                alertMessage(0, response[1]);
                $("#modalNewCategory").find("input[name=\"name\"]").val('');

                $.ajax({

                    url: 'core/ajax.php?action=listNewCategoryOption',
                    type: 'POST',
                    timeout: 60000,
                    success: function(response_list){

                        response_list = eval(response_list);                        

                        $("#categories").append(response_list);
                        $("#categories").multiselect("rebuild");
                        $("#categories").multiselect('select', response[2]);

                    },
                    error: function(erro){

                        alertMessage(1, "<h2 class=\"text-danger\">Erro de comunicação com o servidor!</h2>");

                    }
                });

            } else {

                alertMessage(1, response[1]);

            }
        },
        error: function(erro){

            $("#modalNewCategory").find(".modalMsg").empty();
            alertMessage(1, "<h2 class=\"text-danger\">Erro de comunicação com o servidor!</h2>");

        }

    });

    return false;

});
</script>
