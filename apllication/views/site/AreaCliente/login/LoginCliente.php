<div class="container">
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <!-- Titulo do acesso do Cliente -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="cliente">Acesso do Cliente</h2>
            </div>
        </div>
        <!-- Formulário -->
        <div class="row">
            <div class="col-md-9">
                <form action="<?=base_url('siteController/LogarCliente');?>" method="POST" class="form-horizontal" autocomplete="off">
                    <!-- E-Mail --> 
                    <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">E-Mail</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email" autofocus>
                                <span class="help-block">Informe seu E-mail</span>
                            </div>
                        </div>
                        
                        <!-- Senha -->
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="senha" id="inputPassword3" placeholder="Password">
                                <span class="help-block">Informe sua Senha</span>
                            </div>
                        </div>

                        <!-- Botão de Entrar -->
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                            <a href="<?=base_url('siteController/Cliente');?>" class="btn btn-default">Voltar</a>
                            </div>
                        </div>
                        <!-- Esqueceu a senha -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="lblopcao">&nbsp;&nbsp;&nbsp;</label>
                            <div class="col-md-8">
                                <a id="novaSenha" href="" name="novaSenha" class="btn btn-warning btn-sm btn-group" data-toggle="modal" data-target="#myModal">Esqueceu a senha? Crie uma Nova</a>
                                <a id="novaSenha" href="<?=base_url('siteController/NovoUsuario');?>" name="novaSenha" class="btn btn-primary btn-sm btn-group">Cadastrar um novo usuário</a>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de atualização de Senha -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form action="<?=base_url('siteController/novaSenha');?>" method="post" autocomplete="off">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Esqueceu a Senha?</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="Email">E-Mail: </label>
                        <input type="email" id="Email" name="email" class="form-control" required="" autofocus/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="NovaSenha">Senha Nova: </label>
                        <input type="password" id="NovaSenha" name="NovaSenha" class="form-control" required="" onkeyup="checarSenha()"/>
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
                <button type="submit" id="enviarsenha" class="btn btn-primary" disabled>Salvar</button>
            </div>
            </div>
        </form>
  </div>
</div>