<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Carrinho de Compras</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover" id="carrinho">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Cliente</th>
                        <th>Quantidade de Compra</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if($carrinho > 0){
                        foreach($carrinho as $cart){
                            $produto    = $cart['nomeProduto'];
                            $cliente    = $cart['nomeCliente'];
                            $compra     = $cart['qtd_compras'];
                            $total      = $cart['valor_total'];
                ?>
                    <tr>
                        <td><?=$produto;?></td>
                        <td><?=$cliente;?></td>
                        <td><?=$compra;?></td>
                        <td><?=$total;?></td>
                    </tr>
                <?php
                        }
                    }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Produto</th>
                        <th>Cliente</th>
                        <th>Quantidade de Compra</th>
                        <th>Valor Total</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>