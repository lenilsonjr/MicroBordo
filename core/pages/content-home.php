<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');
?>
<div class="container-fluid">
    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <h1 class="text-center text-primary"><?php echo MicroBordo::getBusinessName(); ?></h1>

            <hr>

            <div class="row">

                <form id="newPost">
                    <div class="form-group">
                        <textarea name="post" class="form-control" placeholder="O que passa pela sua cabeça agora?" rows="8" cols="40"></textarea>
                    </div>
                    <div class="form-group">
                        <div id="tags"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg pull-right">Postar!</button>
                    </div>
                </form>

            </div>

            <hr>

            <div class="row">

                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-search"></i>
                    </div>
                    <input type="text" class="form-control" placeholder="Filtrar posts..." id="tagFiltro">
                </div>

            </div>
            <div id="allPosts">



            </div>

        </div>

    </div>

</div>
<script type="text/javascript">
jQuery(document).ready(function(){

    $("#allPosts").load('core/pages/content-list-posts.php');

    var tags = $("#tags").tags({
        tagSize: "md",
        tagData: []
    });

    $("#newPost").submit(function(){

        var tagss = tags.getTags();

        $.ajax({
            url: 'core/ajax.php?action=newPost',
            type: 'post',
            data: { post: $("textarea[name='post']").val(), tags: tagss},
            timeout: 60000,
            success: function(response){

                response = eval(response);
                alertMessage(response[0], response[1]);

                if (response[0] == 0) {

                    var tags = $("#tags").tags({
                        tagSize: "md",
                        tagData: []
                    });

                    $("textarea[name='post']").val('');
                    $("#allPosts").load('core/pages/content-list-posts.php');
                }

            },
            error: function(erro){
                alertMessage(1, 'Ocorreu um erro de comunicação com o servidor.');
            }
        });

        event.preventDefault();
        return false;
    });

    $(".ptag").click(function(){

        var rex = new RegExp($(this).find(".pntag").text(), 'i');
        $('.post').hide();
        $('.post').filter(function () {
            return rex.test($(this).find(".pntag").text());
        }).show();

    });

    $('#tagFiltro').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.post').hide();
        $('.post').filter(function () {
            return rex.test($(this).text());
        }).show();
    });
});
</script>