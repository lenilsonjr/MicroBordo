<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');
?>
<!-- Modal de Mensagens -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="alertModalLabel"></h4>
            </div>
            <div class="modal-body" id ="alertModalContent">

            </div>
            <div class="modal-footer">
                <button type="button" id="btnDismissAlertModal" class="btn btn-default" data-dismiss="modal">Ok!</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
//Used to clear the alert modal after the user click in Ok
$("#btnDismissAlertModal").click(function(){

    $("#alertModalLabel").empty();
    $("#alertModalContent").empty();

});

//Function used to show messages to the user
function alertMessage(erro, msg) {

    if (erro == 0) {

        $("#alertModalLabel").text('Sucesso!');
        $("#alertModal").find(".modal-content").removeClass("alert-success alert-danger");
        $("#alertModal").find(".modal-content").addClass("alert-success");

    } else {

        $("#alertModalLabel").text('Erro!');
        $("#alertModal").find(".modal-content").removeClass("alert-success alert-danger");
        $("#alertModal").find(".modal-content").addClass("alert-danger");

    }

    $("#alertModalContent").html("<h3>"+msg+"</h3>");
    $("#alertModal").modal('show');

}
</script>
