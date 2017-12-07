<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Produtos
                <a href="<?=base_url('administradorController/novoProduto');?>" class="btn btn-primary pull-right">Novo Produto</a>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table id="produto" class="table table-striped table-cordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>produto</th>
                        <th>Validade</th>
                        <th>Quantidade</th>
                        <th>Descrição</th>
                        <th>Valor Uni</th>
                        <th>Categoria</th>
                        <th>Fornecedor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(0 < count($produtos)){
                        foreach($produtos as $produto){
                            $id = $produto->idProduto;
                ?>
                    <tr>
                        <td><?=$produto->cod_produto;?></td>
                        <td><?=$produto->nomeProduto;?></td>
                        <td><?=$produto->validade;?></td>
                        <td><?=$produto->quantidade;?></td>
                        <td><?=$produto->descricao;?></td>
                        <td><?=$produto->valor;?></td>
                        <td><?=$produto->nomeCategoria?></td>
                        <td><?=$produto->nomeFantasia?></td>
                        <td>
                            <a href="<?=base_url('administradorController/AtualizaProduto/' . $produto->idProduto);?>" class="btn btn-primary btn-sm btn-group" onclick="return confirm('Deseja realmente atualizar o produto?');">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                            <a href="<?=base_url('administradorController/delProduto/'. $produto->idProduto);?>" class="btn btn-warning btn-sm btn-group" onclick="return confirm('Deseja realmente excluir o produto?');">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
                <?php
                        }
                    }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Codigo</th>
                        <th>produto</th>
                        <th>Validade</th>
                        <th>Quantidade</th>
                        <th>Descrição</th>
                        <th>Valor Uni</th>
                        <th>Categoria</th>
                        <th>Fornecedor</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>