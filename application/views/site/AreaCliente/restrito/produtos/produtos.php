<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Lista de Produtos</h2>
        </div>
    </div>

    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <?php 
            if(!empty($produtos)) {
                foreach($produtos as $produto){
                    $id = $produto['idProduto'];
                    $codigo = $produto['cod_produto'];
                    $nome = $produto['nomeProduto'];
                    $valor = $produto['valor'];
                    $id_produto = $produto['idProduto'];
                    $nomeProduto = $produto['nomeProduto'];
            ?>
            <tbody>
                <form action="<?=base_url('carrinhoController/inserirProduto');?>" method="POST">
                    <tr>
                        <td><?=$codigo;?></td>
                        <td><?=$nome;?></td>
                        <td><input type="number" name="quantidade" maxlength = "2" size="3"  class="form-control" value="1"/></td>
                        <td>R$ <?=$valor;?></td>
                        <td><input type="submit" class="btn btn-success btn-sm" value="Comprar"/></td>
                    </tr>
                    <input type="hidden" name="idProduto" value="<?=$id_produto;?>"/>
                    <input type="hidden" name="nomeProduto" value="<?=$nomeProduto;?>"/>
                    <input type="hidden" name="valor" value="<?=$valor;?>"/>
                </form>
            </tbody>
            <?php 
                } 
            }?>
            <tfoot>
                <tr>
                    <th>Código</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>