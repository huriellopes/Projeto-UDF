<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">
            Clientes
            <a href="<?=base_url('gestorController/novoCliente');?>" class="btn btn-primary pull-right">Novo Cliente</a>
        </h2>
    </div>
</div>
<div class="row">
     <div class="col-md-12">
        <table class="display table table-hover" id="cliente" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>CNPJ</th>
                    <th>Tipo</th>
                    <th>Nascimento</th>
                    <th>E-Mail</th>
                    <th>Telefone</th>
                    <th>UF</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(0 < count($cliente)){
                    foreach($cliente as $clientes){
                        $id = $clientes['idcliente'];
            ?>
                <tr>
                    <td><?=$clientes['nomeCliente'];?></td>
                    <td><?=$clientes['Cpf'];?></td>
                    <td><?=$clientes['Cnpj'];?></td>
                    <td><?=$clientes['tipo'];?></td>
                    <td><?=$clientes['nascimentoCliente'];?></td>
                    <td><?=$clientes['email'];?></td>
                    <td><?=$clientes['telefone'];?></td>
                    <td><?=$clientes['uf']==$clientes['uf']?$clientes['uf']:$clientes['uf']?></td>
                    <td><?=$clientes['ativo']=='1'?'Ativo':'Inativo';?></td>
                    <td>
                        <a href="<?=base_url('gestorController/atualizaCliente/' . $id);?>" class="btn btn-primary btn-sm btn-group" title="Atualizar" onclick="return confirm('Deseja atualizar o cliente?');">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>
                        <a href="<?=base_url('gestorController/inativaCliente/' . $id);?>" class="btn btn-warning btn-sm btn-group" title="Inativar" onclick="return confirm('Deseja Inativar o cliente?');">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </a>
                        <a href="<?=base_url('gestorController/atiCliente/' . $id);?>" class="btn btn-success btn-sm btn-group" title="Ativar" onclick="return confirm('Deseja realmente ativar o cliente?');">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
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
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>CNPJ</th>
                    <th>Tipo</th>
                    <th>Nascimento</th>
                    <th>E-Mail</th>
                    <th>Telefone</th>
                    <th>UF</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div><!-- Fim da Row -->
</div>