jQuery(document).ready(function(){

    //Used to clear the alert modal after the user click in Ok
    $("#btnDismissAlertModal").click(function(){

        $("#alertModalLabel").empty();
        $("#alertModalContent").empty();

    });

    //Function used to show messages to the user
    function alertMessage(erro, msg) {

        if (erro == 0) {

            $("#alertModalLabel").text('Sucesso!');

        } else {

            $("#alertModalLabel").text('Erro!');

        }

        $("#alertModalContent").html("<h3>"+msg+"</h3>");

    }

    //Login Form
    $("#formLoginBtn").click(function(e){

      e.preventDefault();
      $.ajax({
          url: 'core/ajax.php?action=login',
          type: 'POST',
          data: $("#formLogin").serialize(),
          timeout: 60000,
          success: function(response){
              response = eval(response);

              if (response[0] == 0) {

                  alertMessage(0, response[1]);

              } else {

                  alertMessage(1, response[1]);

              }
              $("#alertModal").modal('show');

          },
          error: function(erro){

              alertMessage(1, 'Ocorreu um erro de comunicação com o servidor.');

          }
      });

    });
});
