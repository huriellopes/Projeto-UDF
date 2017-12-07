<div class="container">
    <!-- Titulo do acesso do Cliente -->
    <div class="row">
        <div class="col-md-12">
            <h2 class="cliente">Acesso do Funcionário</h2>
        </div>
    </div>
    <!-- Formulário -->
    <div class="row">
        <div class="col-md-9">
            <form action="<?=base_url('loginController/verificarNivel');?>" method="POST" class="form-horizontal" autocomplete="off">
                    <!-- E-Mail --> 
                    <div class="form-group">
                        <label for="cpf" class="col-sm-2 control-label">CPF</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="cpf" maxlength="14" data-mask="000.000.000-00" name="cpf" placeholder="CPF" required="" autofocus autocomplete="on"/>
                            <span class="help-block">Informe seu CPF</span>
                        </div>
                    </div>
                    
                    <!-- Senha -->
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" id="inputPassword3" name="senha" placeholder="Senha" required=""/>
                            <span class="help-block">Informe sua Senha</span>
                        </div>
                    </div>
                    <!-- Botão de Entrar -->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

</div>