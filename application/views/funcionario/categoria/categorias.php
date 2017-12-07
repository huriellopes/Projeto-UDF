<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <!-- Categorias topo -->
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                Categorias
                <a href="<?=base_url('funcionarioController/novaCategoria');?>" class="btn btn-primary pull-right">Nova Categoria</a>
            </h2>
        </div>
    </div> 
    <!-- Tabela -->
    <div class="row">
        <div class="col-md-12">
            <table class="display table table-hover" id="categorias" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(0 < count($categorias)){
                        foreach($categorias as $categoria){
                            $id = $categoria->idcategoria;
                ?>
                    <tr>
                        <td><?=$categoria->nomeCategoria;?></td>
                        <td><?=$categoria->descricao;?></td>
                        <td><?=$categoria->ativo=='1'?'Ativo':'Inativo';?></td>
                        <td>
                            <a href="<?=base_url('funcionarioController/atualizaCategoria/' . $id)?>" class="btn btn-primary btn-sm btn-group" title="Atualizar" onclick="return confirm('Deseja realmente atualizar a categoria?');">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                            <a href="<?=base_url('funcionarioController/inativaCategoria/' . $id);?>" class="btn btn-warning btn-sm btn-group" title="Inativar" onclick="return confirm('Deseja realmente inativar a categoria?');">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                            <a href="<?=base_url('funcionarioController/ativarCategoria/' . $id);?>" class="btn btn-success btn-sm btn-group" title="Ativar" onclick="return confirm('Deseja realmente ativar a categoria?');">
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
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
           <!-- <?=$pagination;?>-->
        </div>
    </div>
</div>