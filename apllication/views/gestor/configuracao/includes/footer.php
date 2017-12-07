    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?=base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?=base_url('assets/js/jquery.mask.js');?>"></script>
    <script src="<?=base_url('assets/sweetAlert/js/sweetalert.min.js');?>"></script>
    <script src="<?=base_url('assets/js/scripts.js');?>"></script>
    <script src="<?=base_url('assets/sweetAlert/js/sweetalert.min.js');?>"></script>
    <script src="<?=base_url('assets/sweetAlert/js/script_sweet.js');?>"></script>
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

      // Função pra validade da tela de produtos.
      $('#txtdata').datepicker({
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

            Data = $('#txtdata').val();
            
            if(ValidaData(Data) != ""){
                $('#div_Data').removeClass("has-error");
                $('#div_Data').addClass("has-success");
            }else{
                alert('Data inválida ou campo vázio, por favor digite uma data válida!');
                $('#div_Data').removeClass("has-success");
                $('#div_Data').addClass("has-error");
            }
          }
      });

      $('.input-daterange').each(function(){
        $(this).datepicker({
          format: 'dd/mm/yyyy',
          clearDates: true,
          language: 'pt-BR'});
      });
    </script>

    <script>
        $(document).ready(function(e){
            $('#salva').on('click',function(e){
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('administradorController/AtualizaSenha/'. $this->session->userdata('idUsuario'));?>",
                    cache: false,
                    data: $('#form').serialize(),
                    dataType: 'json',
                    success: function(response){
                        if(response.status === true){
                            swal('Sucesso','Senha Atualizada com Sucesso','success',document.location.href = response.redirect);   
                        }else{
                            swal("Atenção","Não foi possivel atualizar!","error",document.location.href = response.redirect);
                        }
                    }
                });
            });
        });

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
                document.getElementById("salva").disabled = true;
            }else if(password != confirmPassword){
                $("#divcheck").html("<span class='text-danger'>Senhas não Conferem!</span>");
                document.getElementById("salva").disabled = true;
            }else{
                //alert('passei por aqui!');
                $("#divcheck").html("<span class='text-success'>Senhas Iguais!</span>");
                document.getElementById("salva").disabled = false;
            }
        }
    </script>

    <script>
        $(document).ready(function(e){
            $('#atualizar').on('click',function(e){
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('administradorController/AtualizarDados/'. $this->session->userdata('idUsuario'));?>",
                    cache: false,
                    data: $('#form').serialize(),
                    dataType: 'json',
                    success: function(response){
                        if(response.status === true){
                            swal('Sucesso','Dados Atualizados com Sucesso','success',document.location.href = response.redirect);   
                        }else{
                            swal("Atenção","Não foi possivel atualizar!","error",document.location.href = response.redirect);
                        }
                    }
                });
            });
        });
    </script>
    
  </body>
</html>