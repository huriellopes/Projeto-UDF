<style>
    .informacao{text-align: center;}
    .informacao h3{font-weight: 700; font-size: 1.5em;}
    .informacao p{font-size: 0.9em; font-weight: 400;}
</style>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-9">
            <h2 class="page-header">Atualizar Usuário</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 informacao">
            <h3>Seu CPF: <p><?=$usuario[0]['cpfUsuario'];?></p> </h3>
        </div>
    </div>
    <div id="msg"></div>
    <div class="row">
        <div class="col-md-9">
        <form action="<?=base_url('gestorController/AtualizarDados');?>" method="POST" id="form">
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="hidden" name="idUsuario" id="idUsuario" value="<?=$usuario[0]['idUsuario'];?>"/>
                    <label>Nome: </label>
                    <div class="has-error" id="div_nome">
                        <input type="text" name="nomeUsuario" id="txtnome" value="<?=$usuario[0]['nomeUsuario'];?>" class="form-control" autofocus required=""/>
                        <span class="help-block">Informe o Nome</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- RG -->
                <div class="col-md-6 form-group">
                    <label for="">RG: </label>
                    <div class="" id="div_rg">
                        <input type="text" name="rg" id="txtrg" data-mask="0.000.000" maxlength="9" value="<?=$usuario[0]['rg'];?>" class="form-control">
                        <span class="help-block">Informe o RG</span>
                    </div>
                </div>
                <!-- E-Mail -->
                <div class="col-md-6 form-group">
                    <label for="">Email: </label>
                    <div class="has-error" id="div_email">
                        <input type="txt" name="email" id="txtemail" value="<?=$usuario[0]['email'];?>" class="form-control"/>
                        <span class="help-block">Informe um e-mail válido</span>
                    </div>
                </div>
                <!-- CPF/Login -->
                <!--<div class="col-md-6 form-group">
                    <label for="">CPF:</label>
                    <div class="has-error" id="div_cpf">
                        <input type="text" name="cpfUsuario" id="txtcpf" data-mask="000.000.000-00" maxlength="14" value="<?=$usuario[0]['cpfUsuario'];?>" class="form-control">
                        <span class="help-block">Informe um CPF Válido</span>
                    </div>
                </div>-->
            </div> <!-- Fim da ROW -->

            <div class="row">
                <!-- E-Mail -->
                <!--<div class="col-md-6 form-group">
                    <label for="">Email: </label>
                    <div class="has-error" id="div_email">
                        <input type="txt" name="email" id="txtemail" value="<?=$usuario[0]['email'];?>" class="form-control"/>
                        <span class="help-block">Informe um e-mail válido</span>
                    </div>
                </div>-->
                 <!-- Senha -->
                 <div class="col-md-12 form-group">
                    <label for="">Senha: </label>
                    <div class="has-error" id="div_senha">
                        <input type="button" class="btn btn-default btn-block" value="Atualizar Senha" data-toggle="modal" data-target="#myModal"/>
                    </div>
                </div>
            </div><!-- Fim da ROW -->
            <div class="row">
                <div class="col-md-12 form-group">
                    <button type="submit" id="atualizar" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal de atualização de Senha -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form action="<?=base_url('administradorController/AtualizaSenha');?>" method="post" id="form">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Atualizar a Senha</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="hidden" name="idUsuario" value="<?=$usuario[0]['idUsuario'];?>" id="idUsuario">
                        <label for="Email">Senha Antiga: </label>
                        <input type="password" id="senha_antiga" name="senha" class="form-control" required="" autofocus/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="NovaSenha">Senha Nova: </label>
                        <input type="password" id="NovaSenha" name="senha_nova" class="form-control" required="" onkeyup="checarSenha()"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="ConfirmSenha">Confirmar Senha: </label>
                        <input type="password" id="ConfirmSenha" name="ConfirmSenha" class="form-control" required="" onkeyup="checarSenha()"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div id="divcheck">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" id="salva" class="btn btn-primary" disabled>Salvar</button>
            </div>
            </div>
        </form>
  </div>
</div>