<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="row">
    <div class="col-md-10 novo">
        <h2>Atualizar Dados</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-12 Informacao">
        <h3>Seu CPF/CNPJ: <p><?=$cliente[0]->Cpf;?></p> </h3>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <form action="<?=base_url('siteController/AtualDados');?>" method="POST" id="form">
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="hidden" name="idcliente" id="idcliente" value="<?=$cliente[0]->idcliente;?>"/>
                    <label for="">Nome: </label>
                    <div class="has-error" id="div_nome">
                        <input type="text" name="nomeCliente" id="txtnome" class="form-control" value="<?=$cliente[0]->nomeCliente;?>" autofocus/>
                        <span class="help-block">Informe o nome</span>
                    </div>
                </div>
            </div><!-- FIM da ROW -->

            <div class="row">
                <!-- RG -->
                <div class="col-md-6 form-group">
                    <label for="">RG: </label>
                    <div class="" id="div_rg">
                        <input type="text" name="rg" class="form-control" value="<?=$cliente[0]->rg;?>" maxlength="9" id="txtrg"/>
                        <span class="help-block">Informe um RG Válido</span>
                    </div>
                </div>
                <!-- Data de Nascimento -->
                <div class="col-md-6 form-group">
                    <label for="">Data Nascimento</label>
                    <div class="has-error" id="div_data">
                        <input type="text" name="nascimentoCliente" id="data" class="form-control" value="<?=date('d/m/Y',strtotime(str_replace('-','/',$cliente[0]->nascimentoCliente)));?>" required=""/>
                        <span class="help-block">Informe a data de nascimento</span>
                    </div>
                </div>
                <!-- CPF -->
                <!--<div class="col-md-6 form-group">
                    <label for="">CPF/CNPJ: </label>
                    <div class="has-error" id="div_cpf">
                        <input type="text" class="form-control" name="CpfCnpj" id="txtcpf" value="<?=$cliente[0]->CpfCnpj;?>" maxlength="18" data-mask=["000.000.000-00","00.000.000/0000-00"] autocomplete="off">
                        <span class="help-block">Informe o número do CPF</span>
                    </div>
                </div>-->
            </div><!-- FIM da ROW -->

            <div class="row">
                <!-- E-Mail -->
                <div class="col-md-6 form-group">
                    <label for="">E-Mail: </label>
                    <div class="has-error" id="div_email">
                        <input type="text" name="email" id="txtemail" value="<?=$cliente[0]->email;?>" class="form-control" required=""/>
                        <span class="help-block">Informe um E-Mail</span>
                    </div>
                </div>
                <!-- Senha -->
                <div class="col-md-6 form-group">
                    <label for="Senha">Senha: </label>
                    <div id="div_senha" class="has-error">
                    <input type="button" class="btn btn-primary btn-block" value="Atualizar Senha" data-toggle="modal" data-target="#myModal"/>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="row">
                <!-- Telefone -->
                <div class="col-md-6 form-group">
                    <label for="">Telefone: </label>
                    <div class="has-error" id="div_fone">
                        <input type="text" name="telefone" maxlength="14" value="<?=$cliente[0]->telefone;?>" class="form-control" id="txtfone" required=""/>
                        <span class="help-block">Informe um Telefone</span>
                    </div>
                </div>
                <!-- Sexo -->
                <div class="col-md-6 form-group">
                    <label for="">Sexo: </label>
                    <div class="has-error" id="div_sexo">
                        <select name="sexo" id="txtsexo" class="form-control">
                            <option value disabled="true" selected="true">Selecione</option>
                            <option value="M" <?=$cliente[0]->sexo=='M'?'selected':'';?>>Masculino</option>
                            <option value="F" <?=$cliente[0]->sexo=='F'?'selected':'';?>>Feminino</option>
                        </select>
                    </div>
                </div>
            </div><!-- FIM da ROW -->

            <div class="row">
                <!-- Endereço -->
                <div class="col-md-12 form-group">
                    <label for="">Endereço: </label>
                    <div class="has-error" id="div_endereco">
                        <input type="text" name="endereco" class="form-control" value="<?=$cliente[0]->endereco;?>" id="txtendereco" required=""/>
                        <span class="help-block">Informe o endereço</span>
                    </div>
                </div>                
            </div><!-- FIM da ROW -->

            <div class="row">
                <!-- Número -->
                <div class="col-md-2 form-group">
                    <label for="">N°: </label>
                    <div class="has-error" id="div_numero">
                        <input type="text" name="numero" class="form-control" value="<?=$cliente[0]->numero;?>" id="txtnumero" required=""/>
                        <span class="help-block">Número</span>
                    </div>
                </div>
                <!-- Complemento -->
                <div class="col-md-7 form-group">
                    <label for="">Complemento: </label>
                    <input type="text" name="complemento" value="<?=$cliente[0]->complemento;?>" class="form-control">
                    <span class="help-block">Informe o Complemento do Endereço</span>
                </div>
                <!-- Cep -->
                <div class="col-md-3 form-group">
                    <label for="">CEP: </label>
                    <div class="has-error" id="div_cep">
                        <input type="text" name="cep" maxlength="10" class="form-control" value="<?=$cliente[0]->cep;?>" id="txtcep" required=""/>
                        <span class="help-block">Informe o CEP</span>
                    </div>
                </div>   
            </div>             
            <div class="row">
                <!-- UF -->
                <div class="col-md-4 form-group">
                    <label for="">UF: </label>
                    <div class="has-error" id="div_uf">
                        <select name="uf" id="txtuf" class="form-control" required="">
                        <option value disabled="true" selected="true">Selecione a UF</option>
                        <option value="AL" <?=$cliente[0]->uf=='AL'?'selected':'';?>>AL</option>
                        <option value="AM" <?=$cliente[0]->uf=='AM'?'selected':'';?>>AM</option>
                        <option value="AP" <?=$cliente[0]->uf=='AP'?'selected':'';?>>AP</option>
                        <option value="BA" <?=$cliente[0]->uf=='BA'?'selected':'';?>>BA</option>
                        <option value="CE" <?=$cliente[0]->uf=='CE'?'selected':'';?>>CE</option>
                        <option value="DF" <?=$cliente[0]->uf=='DF'?'selected':'';?>>DF</option>
                        <option value="ES" <?=$cliente[0]->uf=='ES'?'selected':'';?>>ES</option>
                        <option value="GO" <?=$cliente[0]->uf=='GO'?'selected':'';?>>GO</option>
                        <option value="MA" <?=$cliente[0]->uf=='MA'?'selected':'';?>>MA</option>
                        <option value="MG" <?=$cliente[0]->uf=='MG'?'selected':'';?>>MG</option>
                        <option value="MS" <?=$cliente[0]->uf=='MS'?'selected':'';?>>MS</option>
                        <option value="MT" <?=$cliente[0]->uf=='MT'?'selected':'';?>>MT</option>
                        <option value="PA" <?=$cliente[0]->uf=='PA'?'selected':'';?>>PA</option>
                        <option value="PB" <?=$cliente[0]->uf=='PB'?'selected':'';?>>PB</option>
                        <option value="PE" <?=$cliente[0]->uf=='PE'?'selected':'';?>>PE</option>
                        <option value="PI" <?=$cliente[0]->uf=='PI'?'selected':'';?>>PI</option>
                        <option value="PR" <?=$cliente[0]->uf=='PR'?'selected':'';?>>PR</option>
                        <option value="RJ" <?=$cliente[0]->uf=='RJ'?'selected':'';?>>RJ</option>
                        <option value="RN" <?=$cliente[0]->uf=='RN'?'selected':'';?>>RN</option>
                        <option value="RO" <?=$cliente[0]->uf=='RO'?'selected':'';?>>RO</option>
                        <option value="RR" <?=$cliente[0]->uf=='RR'?'selected':'';?>>RR</option>
                        <option value="RS" <?=$cliente[0]->uf=='RS'?'selected':'';?>>RS</option>
                        <option value="SC" <?=$cliente[0]->uf=='SC'?'selected':'';?>>SC</option>
                        <option value="SE" <?=$cliente[0]->uf=='SE'?'selected':'';?>>SE</option>
                        <option value="SP" <?=$cliente[0]->uf=='SP'?'selected':'';?>>SP</option>
                        <option value="TO" <?=$cliente[0]->uf=='TO'?'selected':'';?>>TO</option>
                        </select>
                        <span class="help-block">Informe a UF</span>
                    </div>
                </div>
                <!-- Cidade -->
                <div class="col-md-4 form-group">
                    <label for="">Cidade: </label>
                    <div class="has-error" id="div_cidade">
                        <input type="text" name="cidade" class="form-control" value="<?=$cliente[0]->cidade;?>" id="txtcidade" required=""/>
                        <span class="help-block">Informe a cidade</span>
                    </div>
                </div>
                <!-- Bairro -->
                <div class="col-md-4 form-group">
                    <label for="">Bairro: </label>
                    <div class="has-error" id="div_bairro">
                        <input type="text" name="bairro" class="form-control" value="<?=$cliente[0]->bairro;?>" id="txtbairro" required=""/>
                        <span class="help-block">Informe o Bairro</span>
                    </div>
                </div>
            </div><!-- FIM da ROW -->

            <div class="row">
                <div class="col-md-12 form-group">
                    <button type="submit" id="btnenviar" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<!-- Modal de atualização de Senha -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form action="<?=base_url('siteController/AtualizaSenha');?>" method="post" id="senha">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Atualizar a Senha</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="hidden" name="idcliente" value="<?=$cliente[0]->idcliente;?>" id="idcliente">
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
                <button type="submit" id="enviarsenha" class="btn btn-primary" disabled>Salvar</button>
            </div>
            </div>
        </form>
  </div>
</div>