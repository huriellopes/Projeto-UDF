<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                Usuários
                <a href="<?=base_url('administradorController/novoUsuario');?>" class="btn btn-primary pull-right">Novo Usuário</a>
            </h2>
        </div>
    </div>
    <div class="row">
         <div class="col-md-12">
			<table id="example" class="display table table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Nome</th>
						<th>CPF</th>
						<th>E-mail</th>
						<th>Nivel</th>
						<th>Status</th>
                        <th>Ações</th>
					</tr>
				</thead>
                <tbody>
                <?php
                  if(0 < count($usuario)){
                    foreach($usuario as $user){ 
                        $id = $user->idUsuario;
                ?>
                    <tr>
                        <td><?=$user->nomeUsuario;?></td>
                        <td><?=$user->cpfUsuario;?></td>
                        <td><?=$user->email;?></td>
                        <td><?=$user->descricao;?></td>
                        <td><?=$user->ativo=='1'?'Ativo':'Inativo';?></td>
                        <td>
                            <a href="<?=base_url('administradorController/inatUsuario/' . $id);?>" class="btn btn-warning btn-sm btn-group" title="Inativar" onclick="return confirm('Deseja realmente inativar o usuario?');">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                            <a href="<?=base_url('administradorController/atiUsuario/' . $id);?>" class="btn btn-success btn-sm btn-group" title="Ativar" onclick="return confirm('Deseja realmente ativar o usuario?');">
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
						<th>E-mail</th>
						<th>Nivel</th>
						<th>Status</th>
                        <th>Ações</th>
					</tr>
				</tfoot>
			</table>
        </div>
    </div>
</div>