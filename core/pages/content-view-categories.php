<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');
?>
<div class="row">
    <h2 class="page-header text-center">
        Ver categorias
    </h2>
</div>

<div class="row">

        <?php echo MicroBordo::getContent('list-categories'); ?>

        <!-- Modal de visualização da categoria -->
        <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">

                        <div class="row categoryData" style="padding: 10px;">
                            <form id="formModalCategory">

                                <?php echo MicroBordo::getContent('form-category'); ?>

                            </form>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn-save-category">Salvar</button>
                        <button type="button" class="btn btn-primary" id="btn-edit-category">Editar</button>
                        <button type="button" class="btn btn-danger" id="btn-delete-category">Excluir</button>
                        <button type="button" class="btn btn-default" id="btn-close-category" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">

        var modal = $("#modalView");
        modal.find("#btn-save-category").hide();

        $('#modalView').on('hide.bs.modal', function (event) {

            modal.find("#btn-save-category").hide();
            modal.find("#btn-edit-category").show();
            modal.find("input").attr('readonly', 'readonly');
            modal.find("textarea").attr('readonly', 'readonly');

        });

        $("#btn-delete-category").click(function(){

            var idr = modal.find("input[name='id']").val();

            $.ajax({
                url: 'core/ajax.php?action=deleteCategory',
                method: 'POST',
                data: {id: idr},
                timeout: 60000,
                success: function(response){

                    response = eval(response);

                    //If success, let's do something
                    if (response[0] == 0) {

                        modal.find("input").attr('readonly', 'readonly');
                        modal.find("textarea").attr('readonly', 'readonly');

                        modal.find('.categoryData').hide();
                        alertMessage(0, response[1]);

                        modal.find("#btn-delete-category").hide();
                        modal.find("#btn-edit-category").hide();

                        $("#category-"+idr).remove();

                    } else {

                        alertMessage(1, response[1]);

                    }
                },
                error: function(erro){

                    alertMessage(1, "<h2 class=\"text-danger\">Erro de comunicação com o servidor!</h2>");

                }

            });

        });

        $("#btn-edit-category").click(function(){

            modal.find("#btn-save-category").show();
            modal.find("#btn-edit-category").hide();
            modal.find("input").removeAttr('readonly');
            modal.find("textarea").removeAttr('readonly');
            modal.find("select").removeAttr('disabled');

        });

        $("#btn-save-category").click(function(){

            $.ajax({
                url: 'core/ajax.php?action=editCategory',
                method: 'POST',
                data: $("#formModalCategory").serialize(),
                timeout: 60000,
                success: function(response){

                    response = eval(response);

                    //If success, let's do something
                    if (response[0] == 0) {

                        alertMessage(0, response[1]);

                        modal.find('.categoryData').show();

                        modal.find("input").attr('readonly', 'readonly');
                        modal.find("textarea").attr('readonly', 'readonly');
                        modal.find("select").attr('disabled', 'disabled');

                        modal.find('.modal-title').text(response[1][0]['name']);
                        modal.find('input[name="id"]').val(response[1][0]['id']);

                        modal.find('input[name="name"]').val(response[1][0]['name']);

                        $("#category-"+response[1][0]['id']).find('.category-name').text(response[1][0]['name']);


                    } else {
                        alertMessage(1, response[1]);
                    }
                },
                error: function(erro){

                    alertMessage(1, "<h2 class=\"text-danger\">Erro de comunicação com o servidor!</h2>");

                }

            });

            modal.find("#btn-save-category").hide();
            modal.find("#btn-edit-category").show();
            modal.find("input").attr('readonly', 'readonly');
            modal.find("textarea").attr('readonly', 'readonly');
            modal.find("select").attr('disabled', 'disabled');

        });

        $('#modalView').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var idp = button.data('id');

            modal.find("#btn-delete-category").show();
            modal.find("#btn-edit-category").show();

            modal.find('.categoryData').hide();
            modal.find('.modal-title').html("Aguarde...");
            modal.find("#btn-save-category").hide();
            $.ajax({
                url: 'core/ajax.php?action=viewCategory',
                method: 'POST',
                data: {id: idp},
                timeout: 60000,
                success: function(response){

                    response = eval(response);

                    //If success, let's do something
                    if (response[0] == 0) {

                        modal.find('.categoryData').show();

                        modal.find("input").attr('readonly', 'readonly');
                        modal.find("textarea").attr('readonly', 'readonly');
                        modal.find("select").attr('disabled', 'disabled');

                        modal.find('.modal-title').text(response[1][0]['name']);
                        modal.find('input[name="id"]').val(response[1][0]['id']);
                        modal.find('input[name="name"]').val(response[1][0]['name']);

                    } else {
                        alertMessage(1, response[1]);
                    }
                },
                error: function(erro){

                    alertMessage(1, "<h2 class=\"text-danger\">Erro de comunicação com o servidor!</h2>");

                }

            });

        });

        //Pagination navigation
        $(".pagBtn").click(function(){

            var item = $(this);
            var p = $(item).attr('href');

            $.ajax({
                url: 'core/ajax.php?action=pag',
                data: {
                    page: 'view-categories',
                    p: p,
                },
                type: 'POST',
                timeout: 60000,
                success: function(response){

                    response = eval(response);
                    $(".main").load(response);

                },
            });

            return false;
        });
        </script>

</div>
