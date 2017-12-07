<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Nova Venda</h2>
        </div>
    </div><!-- Fim da Row -->
    <div class="row">
        <!-- Icones de vendas -->
        <div class="col-md-12">
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Busca Cliente">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Busca Produto">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                </span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Forma de Pagamento">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-usd"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-ok"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <form role="form" action="<?=base_url('funcionarioController/insereVenda');?>" method="POST" autocomplete="off">
                    <!-- Formulários -->
                    <div class="tab-content">
                        <!-- Busca de Clientes -->
                        <div class="tab-pane active" role="tabpanel" id="step1">
                            <div class="row">
                                <div class="col form-group">
                                    <h3>Buscar Cliente:</h3>
                                    <select name="id_cliente" class="form-control">
                                        <option value disabled="true" selected="true">Selecione o Cliente</option>
                                        <?php
                                            if($busca > 0){
                                                foreach($busca as $cliente){
                                        ?>
                                            <option value="<?=$cliente['idcliente'];?>"><?=$cliente['nomeCliente'];?></option>
                                        <?php
                                            }
                                        }?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Busca de Produtos -->
                        <div class="tab-pane" role="tabpanel" id="step2">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h3>Buscar Produtos: </h3>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <?php 
                                            if(!empty($produto)){
                                                foreach($produto as $product){
                                            ?>
                                                <input type="checkbox" id="produto" name="id_produto" value="<?=$product['idProduto']?>"> <?=$product['nomeProduto'];?><br>
                                            <?php
                                                }
                                            }else{
                                                echo "<strong>Não há Produtos!</strong>";
                                            } 
                                            ?>
                                        </div>
                                        <div class="col-md-6 input-group">
                                            <input type="button" value="+" onclick="mais('quantidade')">
                                            <input type="text" name="qtd_vendida" id="quantidade" class="form-control" value="0" size="1" readonly="readonly"/>
		                                    <input type="button" value="-" onclick="menos('quantidade')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Formas de Pagamentos -->
                        <div class="tab-pane" role="tabpanel" id="step3">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h3>Formas de Pagamento: </h3>
                                    <select name="id_forma" class="form-control">
                                        <option value disabled="true" selected="true">Selecione uma Forma de Pagamento</option>
                                    <?php
                                        if(0 < count($forma)){
                                            foreach($forma as $formas){
                                    ?>
                                                <option value="<?=$formas['idforma'];?>"><?=$formas['descricao'];?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="submit" class="btn btn-default next-step">Skip</button></li>
                                        <li><button type="submit" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Finalização -->
                        <div class="tab-pane" role="tabpanel" id="complete">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h3>Finalizado</h3>
                                    <p>Venda Concluída com Sucesso!</p>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>