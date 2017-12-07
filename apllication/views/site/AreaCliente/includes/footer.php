        <div class="row">
            <div class="col-md-12 footer">
                <p>&#174; - Todos os Direitos Reservados - Equipe XI</p>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?=base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?=base_url('assets/js/jquery.mask.js');?>"></script>
    <script src="<?=base_url('assets/js/scripts.js');?>"></script>
    <script src="<?=base_url('assets/sweetAlert/js/sweetalert.min.js');?>"></script>
    <script src="<?=base_url('assets/js/jquery.validate.min.js');?>"></script>
    <script src="<?=base_url('assets/js/additional-methods.min.js');?>"></script>
    <script src="<?=base_url('assets/js/validate.js');?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?=base_url('assets/js/bootstrap-datepicker.min.js');?>"></script>
    <script src="<?=base_url('assets/js/locales/bootstrap-datepicker.pt-BR.min.js');?>"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?=base_url('assets/js/holder.min.js'); ?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
    <script>
      $('#data').datepicker({
          format: 'dd/mm/yyyy',
          language: 'pt-BR',
          //weekStart: 0,
          //startDate:'0d',
          clearDates: true,
          todayHighlight: true,
          //defaultViewDate: 'year',
          nextText: 'Proximo',
          prevText: 'Anterior',
          onclose: function(){
              var data = $('#data').val();
              if(dataValidate(data)){
                 $('#div_data').removeClass("has-error");
                 $('#div_data').addClass("has-success");
              }else{
                 alert('Digite uma data válida!');
                 $('#data').val("");
                 $('#div_data').removeClass("has-success");
                 $('#div_data').addClass("has-error");
              }
          }
      });
    </script>

    <script>
        // Função de verificação de Senha
        $(document).ready(function(e){
            $("#NovaSenha").keyup(checarSenha);
            $("#ConfirmSenha").keyup(checarSenha);
        });

        // Função de checar a senha
        function checarSenha(){
            var password = $("#NovaSenha").val();
            var confirmPassword = $("#ConfirmSenha").val();
            
            if(password == '' || '' == confirmPassword){
                $("#divcheck").html("<span class='text-warning'>Campo de senha Vazio!</span>");
                document.getElementById("enviarsenha").disabled = true;
            }else if(password != confirmPassword){
                $("#divcheck").html("<span class='text-danger'>Senhas não Conferem!</span>");
                document.getElementById("enviarsenha").disabled = true;
            }else{
                //alert('passei por aqui!');
                $("#divcheck").html("<span class='text-success'>Senhas Iguais!</span>");
                document.getElementById("enviarsenha").disabled = false;
            }
        }
    </script>
  </body>
</html>