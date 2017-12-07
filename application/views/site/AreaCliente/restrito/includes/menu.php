<?php
    $nome = $this->session->userdata('nomeCliente');
    $id = $this->session->userdata('idcliente');
    $this->session->userdata('Cpf');
    $qtd = $this->cart->total_items();
?>
<div class="row">
    <div class="col-md-12">
        <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- NOME DO SITE -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand inicial" href="<?=base_url('siteController/AreaCliente');?>">Seu negócio Sob Controle</a>
            </div>

            <!-- MENU -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?=base_url('siteController/AreaCliente');?>">Início</a></li>
                    <li>
                        <a href="<?=base_url('siteController/Produtos');?>" title="Produtos">
                            Produtos
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url('carrinhoController/listar');?>" title="Carrinho de Compra">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> <span class="badge"><?=$qtd;?></span>
                        </a>
                    </li>
                    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$nome;?><span class="caret"></span></a>
                       <ul class="dropdown-menu">
                         <li><a href="<?=base_url('siteController/atualizarDados/' . $id);?>">Atualizar Dados</a></li>
                         <li role="separator" class="divider"></li>
                         <li><a href="<?=base_url('siteController/logoutCliente')?>" onclick="return confirm('Deseja Realmente Sair do sistema?');">Logout</a></li>
                       </ul>
                     </li>
                   </ul>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        </nav>
    </div>
</div>