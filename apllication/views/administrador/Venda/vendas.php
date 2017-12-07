<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                vendas
                <a href="<?=base_url('administradorController/novaVenda');?>" class="btn btn-primary pull-right">Nova Venda</a>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <table id="vendas" class="display table table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
                        <th>Cliente</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Código</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                        <th>Valor Total</th>
                        <th>Forma de Pagamento</th>
					</tr>
				</thead>
                <tbody>
                <?php
                  if(0 < count($venda)){
                    foreach($venda as $vendas){ 
                ?>
                    <tr>
                        <td><?=$vendas['nomeCliente'];?></td>
                        <td><?=$vendas['Cpf'];?></td>
                        <td><?=$vendas['telefone'];?></td>
                        <td><?=$vendas['cod_produto'];?></td>
                        <td><?=$vendas['nomeProduto'];?></td>
                        <td><?=$vendas['qtd_vendida'];?></td>
                        <td><?=$vendas['valor'];?></td>
                        <td><?=$vendas['valor']*$vendas['qtd_vendida']?></td>
                        <td><?=$vendas['descricao'];?></td>
                    </tr>
                <?php
                    }
                 }
                ?>                    
                </tbody>
				<tfoot>
				    <tr>
                        <th>Cliente</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Código</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                        <th>Valor Total</th>
                        <th>Forma de Pagamento</th>
					</tr>
				</tfoot>
			</table>
        </div>
    </div>
</div>