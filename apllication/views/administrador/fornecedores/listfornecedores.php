<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                Fornecedores
                <a href="<?=base_url('administradorController/novoFornecedor');?>" class="btn btn-primary pull-right">Novo Fornecedor</a>
            </h2>
        </div>
    </div><!-- FIM da ROW -->

    <div class="row">
        <div class="col-md-12">
            <table id="fornecedor" class="display table table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nome Fantasia</th>
                        <th>Razão Social</th>
                        <th>CNPJ</th>
                        <th>Criação</th>
                        <th>E-Mail</th>
                        <th>Telefone</th>
                        <th>UF</th>
                        <th>Cidade</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(0 < count($fornecedor)){
                        foreach($fornecedor as $fornecedores){
                            $id = $fornecedores->idfornecedor;
                ?>
                    <tr>
                        <td><?=$fornecedores->nomeFantasia;?></td>
                        <td><?=$fornecedores->razaoSocial;?></td>
                        <td><?=$fornecedores->cnpj;?></td>
                        <td><?=$fornecedores->dataCriacao;?></td>
                        <td><?=$fornecedores->email;?></td>
                        <td><?=$fornecedores->telefone;?></td>
                        <td><?=$fornecedores->uf;?></td>
                        <td><?=$fornecedores->cidade;?></td>
                        <td><?=$fornecedores->ativo=='1'?'Ativo':'Inativo'?></td>
                        <td>
                            <a href="<?=base_url('administradorController/atualizaForn/' . $id);?>" class="btn btn-primary btn-sm btn-group" onclick="return confirm('Deseja realmente atualizar o fornecedor?');">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                            <a href="<?=base_url('administradorController/inatForn/' . $id);?>" class="btn btn-warning btn-sm btn-group" title="Inativar" onclick="return confirm('Deseja realmente inativar o fornecedor?');">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                            <a href="<?=base_url('administradorController/atForne/' . $id);?>" class="btn btn-success btn-sm btn-group" title="Ativar" onclick="return confirm('Deseja realmente ativar o fornecedor?');">
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
                        <th>Nome Fantasia</th>
                        <th>Razão Social</th>
                        <th>CNPJ</th>
                        <th>Criação</th>
                        <th>E-Mail</th>
                        <th>Telefone</th>
                        <th>UF</th>
                        <th>Cidade</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div><!-- Fim da Row -->
</div>