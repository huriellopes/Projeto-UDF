    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?=base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?=base_url('assets/js/jquery-ui.min.js');?>"></script>
    <script src="<?=base_url('assets/js/jquery.mask.js');?>"></script>
    <script src="<?=base_url('assets/js/jquery.maskMoney.js');?>"></script>
    <script src="<?=base_url('assets/js/jquery.easy-autocomplete.min.js');?>"></script>
    <script src="<?=base_url('assets/js/scripts.js');?>"></script>
    <script src="<?=base_url('assets/sweetAlert/js/sweetalert.min.js');?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?=base_url('bower_components/datatables.net/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?=base_url('assets/js/dataTables.buttons.min.js');?>"></script>
    <script src="<?=base_url('assets/js/jszip.min.js');?>"></script>
    <script src="<?=base_url('assets/js/pdfmake.min.js');?>"></script>
    <script src="<?=base_url('assets/js/vfs_fonts.js');?>"></script>
    <script src="<?=base_url('assets/js/buttons.print.min.js');?>"></script>
    <script src="<?=base_url('assets/js/buttons.html5.min.js');?>"></script>
    <script src="<?=base_url('assets/js/bootstrap-datepicker.min.js');?>"></script>
    <script src="<?=base_url('assets/js/locales/bootstrap-datepicker.pt-BR.min.js');?>"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?=base_url('assets/js/holder.min.js'); ?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>

    <!-- FUNÇÃO DE MASK VALOR (R$) -->
    <script>
        // Função de mascara de valor (R$)!
        $(document).ready(function(){
            $("#txtvalor").maskMoney({
                prefix:'R$ ', 
                allowNegative: true, 
                thousands:'.', 
                decimal:',', 
                affixesStay: false
            });
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

    <!-- FUNÇÃO QUE CARREGA AS TABELAS (DataTable) -->
    <script>
        $(document).ready(function() {
			//Definimos uma variável para receber o DataTable
			//Essa variável vai permitir exexcutar operações com o DataTable posteriormente
			var el_datatable = $('#example').DataTable({
                "destroy": true,
                "pageLength": 3,
				"processing": true, //Exibe a informação de que o conteúdo está sendo processado
                "serverSide": false, //Define se a busca e a paginação serão a nivel server-side ou client-side
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        "extend": 'print',
                        "text": 'Imprimir',
                        "autoPrint": true
                    },
                    'excelHtml5',
                    'pdfHtml5'
                ],
				"aoColumnDefs": [
                    {"bSortable": false, "aTargets": [0]}
                  ],
                  "aaSorting": [[0, 'asc']],
                  "oLanguage": {
                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
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
            
            // Clientes
            var clientes = $('#cliente').DataTable({
                "destroy": true,
                "pageLength": 5,
				"processing": true, //Exibe a informação de que o conteúdo está sendo processado
                "serverSide": false, //Define se a busca e a paginação serão a nivel server-side ou client-side
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        "extend": 'print',
                        "text": 'Imprimir',
                        "autoPrint": true
                    },
                    'excelHtml5',
                    'pdfHtml5'
                ],
				"aoColumnDefs": [
                    {"bSortable": false, "aTargets": [0]}
                  ],
                  "aaSorting": [[0, 'asc']],
                  "oLanguage": {
                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
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
            
            // Produtos
            var produtos = $('#produto').DataTable({
                "destroy": true,
                "pageLength": 5,
				"processing": true, //Exibe a informação de que o conteúdo está sendo processado
                "serverSide": false, //Define se a busca e a paginação serão a nivel server-side ou client-side
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        "extend": 'print',
                        "text": 'Imprimir',
                        "autoPrint": true
                    },
                    'excelHtml5',
                    'pdfHtml5'
                ],
				"aoColumnDefs": [
                    {"bSortable": false, "aTargets": [0]}
                  ],
                  "aaSorting": [[0, 'asc']],
                  "oLanguage": {
                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
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

            // Categorias
            var categorias = $('#categorias').DataTable({
                "destroy": true,
                "pageLength": 5,
				"processing": true, //Exibe a informação de que o conteúdo está sendo processado
                "serverSide": false, //Define se a busca e a paginação serão a nivel server-side ou client-side
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        "extend": 'print',
                        "text": 'Imprimir',
                        "autoPrint": true
                    },
                    'excelHtml5',
                    'pdfHtml5'
                ],
				"aoColumnDefs": [
                    {"bSortable": false, "aTargets": [0]}
                  ],
                  "aaSorting": [[0, 'asc']],
                  "oLanguage": {
                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
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

            // Vendas
            var vendas = $('#vendas').DataTable({
                "destroy": true,
                "pageLength": 5,
				"processing": true, //Exibe a informação de que o conteúdo está sendo processado
                "serverSide": false, //Define se a busca e a paginação serão a nivel server-side ou client-side
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        "extend": 'print',
                        "text": 'Imprimir',
                        "autoPrint": true
                    },
                    'excelHtml5',
                    'pdfHtml5'
                ],
				"aoColumnDefs": [
                    {"bSortable": false, "aTargets": [0]}
                  ],
                  "aaSorting": [[0, 'asc']],
                  "oLanguage": {
                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
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

            // Carrinho
            var carrinho = $('#carrinho').DataTable({
                "destroy": true,
                "pageLength": 5,
				"processing": true, //Exibe a informação de que o conteúdo está sendo processado
                "serverSide": false, //Define se a busca e a paginação serão a nivel server-side ou client-side
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        "extend": 'print',
                        "text": 'Imprimir',
                        "autoPrint": true
                    },
                    'excelHtml5',
                    'pdfHtml5'
                ],
				"aoColumnDefs": [
                    {"bSortable": false, "aTargets": [0]}
                  ],
                  "aaSorting": [[0, 'asc']],
                  "oLanguage": {
                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
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

            // Fornecedor
            var fornecedor = $('#fornecedor').DataTable({
                "destroy": true,
                "pageLength": 5,
				"processing": true, //Exibe a informação de que o conteúdo está sendo processado
                "serverSide": false, //Define se a busca e a paginação serão a nivel server-side ou client-side
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        "extend": 'print',
                        "text": 'Imprimir',
                        "autoPrint": true
                    },
                    'excelHtml5',
                    'pdfHtml5'
                ],
				"aoColumnDefs": [
                    {"bSortable": false, "aTargets": [0]}
                  ],
                  "aaSorting": [[0, 'asc']],
                  "oLanguage": {
                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
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
    
    <!-- FUNÇÃO DE CALENDÁRIO -->
    <script>
      $('#data').datepicker({
          format: 'dd/mm/yyyy',
          language: 'pt-BR',
          //weekStart: 0,
          //startDate:'0d',
          clearDates: true,
          todayHighlight: true,
          autoclose: true,
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

      // FUNÇÃO DE DATA DOS RELATÓRIOS
      $('.input-daterange').each(function(){
        $(this).datepicker({
          format: 'dd/mm/yyyy',
          clearDates: true,
          language: 'pt-BR',
          //weekStart: 0,
          minDate: 1, 
          maxDate: "+1M",
          autoclose: true,
          todayHighlight: true,
          showOtherMonths: true,
          selectOtherMonths: true
          //defaultViewDate: 'year',
        });
      });
    </script>
    
    <!-- FUNÇÃO DE VENDAS -->
    <script>
        $(document).ready(function () {
            //Initialize tooltips
            $('.nav-tabs > li a[title]').tooltip();
            
            //Wizard
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                var $target = $(e.target);
            
                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);

            });
            $(".prev-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                prevTab($active);

            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }
        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }
    </script>

    <!-- -->
    <script>
        function id( el ){
            return document.getElementById( el );
        }
        function menos( id_qnt ){
            var qnt = parseInt( id( id_qnt ).value );
            if( qnt > 0 )
                id( id_qnt ).value = qnt - 1; 
        } 
        function mais( id_qnt ){
            id( id_qnt ).value = parseInt( id( id_qnt ).value ) + 1; 
        } 
    </script>

  </body>
</html>