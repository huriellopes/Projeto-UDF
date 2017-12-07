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
    <script src="<?=base_url('assets/sweetAlert/js/sweetalert.min.js');?>"></script>
    <script src="<?=base_url('assets/js/scripts.js');?>"></script>
    <script src="<?=base_url('assets/js/print.min.js');?>"></script>
    <script src="<?=base_url('assets/js/jquery.validate.min.js');?>"></script>
    <script src="<?=base_url('assets/js/additional-methods.min.js');?>"></script>
    <script src="<?=base_url('assets/js/validate.js');?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?=base_url('bower_components/datatables.net/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?=base_url('assets/js/bootstrap-datepicker.min.js');?>"></script>
    <script src="<?=base_url('assets/js/locales/bootstrap-datepicker.pt-BR.min.js');?>"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?=base_url('assets/js/holder.min.js'); ?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>

    <script>
       $(document).ready(function(){
           $('#imprime').on("click",function(){
                var imprime = $('#imprime').val();
                var boleto = $('#boleto').val();

               console.log(imprime);
           });
       });
    </script>

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
    
      <!-- FUNÇÃO DE BUSCA DE CEP -->
      <script>
        // FUNÇÃO DE BUSCA DE CEP, CONSUMINDO DO WEBSERVICE https://viacep.com.br
        $(document).ready(function() {
            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#txtendereco").val("");
                $("#txtbairro").val("");
                $("#txtcidade").val("");
                $("#txtuf").val("");
            }
                        
            //Quando o campo cep perde o foco.
            $("#txtcep").blur(function() {
                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');
                
                //Verifica se campo cep possui valor informado.
                if (cep != ""){
                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;
                    
                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {
                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#txtendereco").val("...");
                        $("#txtbairro").val("...");
                        $("#txtcidade").val("...");
                        $("#txtuf").val("...");
            
                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados){
            
                            if (!("erro" in dados)){
                                //Atualiza os campos com os valores da consulta.
                                $("#txtendereco").val(dados.logradouro);
                                $("#txtbairro").val(dados.bairro);
                                $("#txtcidade").val(dados.localidade);
                                $("#txtuf").val(dados.uf);
                            }else{
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    }else{
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                }else{
                   //cep sem valor, limpa formulário.
                   limpa_formulário_cep();
                }
            });
        });     
    </script>

    <script>
        $(document).ready(function(e){
            $("#btnenviar").on('click',function(){
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('siteController/AtualDados/'. $this->session->userdata('idcliente'));?>",
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

            $("#enviarsenha").on('click',function(){
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('siteController/AtualizaSenha/' . $this->session->userdata('idcliente'));?>",
                    chace: false,
                    data: $('#senha').serialize(),
                    dataType: 'json',
                    success: function(response){
                        if(response.status === true){
                            alert("salvou");
                            swal("Sucesso","Senha Atualizada com Sucesso","success", document.location.href = response.redirect);
                        }else{
                            swal("Atenção","Não foi possível atualizar a senha!","error", document.location.href = response.redirect);
                        }
                    }
                });
            });
            
        });
    </script>
    <script>
         $(document).ready(function(){
                // Produtos
                var produtos = $('#produto').DataTable({
                        "destroy": true,
                        "pageLength": 10,
                        "processing": true, //Exibe a informação de que o conteúdo está sendo processado
                        "serverSide": false, //Define se a busca e a paginação serão a nivel server-side ou client-side
                        "aoColumnDefs": [
                            {"bSortable": true, "aTargets": [0]}
                        ],
                        "aaSorting": [[0, 'asc']],
                        "oLanguage": {
                            "sProcessing": "Aguarde enquanto os dados são carregados ...",
                            "sLengthMenu": "Mostrar _MENU_ registros",
                            "sZeroRecords": "Nenhum registro encontrado",
                            "sInfoEmpty": "Exibindo 0 a 0 de 0 registros",
                            "sInfo": "Exibindo de _START_ até _END_ de _TOTAL_ registros",
                            "sInfoFiltered": "",
                            "sSearch": "Buscar: ",
                            "oPaginate": {
                                "sFirst": "Início",
                                "sPrevious": "Anterior",
                                "sNext": "Próximo",
                                "sLast": "Último"
                            }
                        }
                });
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