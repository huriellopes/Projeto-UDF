<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Atualizar Cliente</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <form action="<?=base_url('funcionarioController/atCliente');?>" method="POST" id="form">
            <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center form-group">
                        <label for="">Tipo de Pessoa:</label>
                        <div class="has-error" id="div_pessoa">
                            <select name="id_tipo" id="txtpessoa" class="form-control">
                                <option value disabled="true" selected="true">Selecione um tipo</option>
                                <?php foreach($tipo as $type){?>
                                    <option value="<?=$type['idtipo'];?>"<?=$cliente[0]->id_tipo==$type['idtipo']?'selected':'';?>><?=$type['descricao'];?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block">Selecione um Tipo de Pessoa</span>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="hidden" id="idcliente" name="idcliente" value="<?=$cliente[0]->idcliente;?>"/>
                    <label for="">Nome: </label>
                    <div class="has-error" id="div_nome">
                        <input type="text" name="nomeCliente" id="txtnome" class="form-control" autofocus value="<?=$cliente[0]->nomeCliente;?>" required=""/>
                        <span class="help-block">Informe o nome</span>
                    </div>
                </div>
            </div><!-- FIM da ROW -->

            <div class="row">
                <!-- RG -->
                <div class="col-md-6 form-group">
                    <label for="">RG: </label>
                    <div class="" id="div_rg">
                        <input type="text" name="rg" class="form-control" maxlength="9" value="<?=$cliente[0]->rg;?>" id="txtrg"/>
                        <span class="help-block">Informe um RG Válido</span>
                    </div>
                </div>
                <!-- CPF -->
                <div class="col-md-6 form-group" id="idcpf" styel="display:none">
                    <label for="">CPF: </label>
                    <div class="has-error" id="div_cpf">
                        <input type="text" class="form-control" name="Cpf" id="txtcpf" data-mask="000.000.000-00" value="<?=$cliente[0]->Cpf;?>" maxlength="18" autocomplete="off">
                        <span class="help-block">Informe o número do CPF</span>
                    </div>
                </div>
                <!-- CNPJ -->
                <div class="col-md-6 form-group" id="idcnpj" style="display:none">
                    <label for="">CNPJ: </label>
                    <div class="has-error" id="div_cnpj">
                        <input type="text" class="form-control" name="Cnpj" id="txtcnpj" data-mask="00.000.000/0000-00" value="<?=$cliente[0]->Cnpj;?>" maxlength="20" autocomplete="off">
                        <span class="help-block">Informe o número do CNPJ</span>
                    </div>
                </div>
            </div><!-- FIM da ROW -->

            <div class="row">
                <!-- Data de Nascimento -->
                <div class="col-md-6 form-group">
                    <label for="">Data Nascimento</label>
                    <div class="has-error" id="div_data">
                        <input type="text" name="nascimentoCliente" id="data" class="form-control" value="<?=date('d/m/Y',strtotime(str_replace('-','/',$cliente[0]->nascimentoCliente)));?>" required=""/>
                        <span class="help-block">Informe a data de nascimento</span>
                    </div>
                </div>
                <!-- E-Mail -->
                <div class="col-md-6 form-group">
                    <label for="">E-Mail: </label>
                    <div class="has-error" id="div_email">
                        <input type="text" name="email" id="txtemail" class="form-control" value="<?=$cliente[0]->email;?>" required=""/>
                        <span class="help-block">Informe um E-Mail</span>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="row">
                <!-- Telefone -->
                <div class="col-md-6 form-group">
                    <label for="">Telefone: </label>
                    <div class="has-error" id="div_fone">
                        <input type="text" name="telefone" maxlength="14" class="form-control" id="txtfone" value="<?=$cliente[0]->telefone;?>" required=""/>
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
                <div class="col-md-10 form-group">
                    <label for="">Endereço: </label>
                    <div class="has-error" id="div_endereco">
                        <input type="text" name="endereco" class="form-control" id="txtendereco" value="<?=$cliente[0]->endereco;?>" required=""/>
                        <span class="help-block">Informe o endereço</span>
                    </div>
                </div>
                <!-- Número -->
                <div class="col-md-2 form-group">
                    <label for="">N°: </label>
                    <div class="has-error" id="div_numero">
                        <input type="text" name="numero" class="form-control" id="txtnumero" value="<?=$cliente[0]->numero;?>" required=""/>
                        <span class="help-block">Número</span>
                    </div>
                </div>
            </div><!-- FIM da ROW -->

            <div class="row">
                <!-- Complemento -->
                <div class="col-md-6 form-group">
                    <label for="">Complemento: </label>
                    <input type="text" name="complemento" class="form-control" value="<?=$cliente[0]->complemento;?>"/>
                    <span class="help-block">Informe o Complemento do Endereço</span>
                </div>
                <!-- Cep -->
                <div class="col-md-3 form-group">
                    <label for="">CEP: </label>
                    <div class="has-error" id="div_cep">
                        <input type="text" name="cep" maxlength="10" class="form-control" id="txtcep" value="<?=$cliente[0]->cep;?>" required=""/>
                        <span class="help-block">Informe o CEP</span>
                    </div>
                </div>
                <!-- UF -->
                <div class="col-md-3 form-group">
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
            </div><!-- FIM da ROW -->
            
            <div class="row">
                <!-- Cidade -->
                <div class="col-md-4 form-group">
                    <label for="">Cidade: </label>
                    <div class="has-error" id="div_cidade">
                        <input type="text" name="cidade" class="form-control" id="txtcidade" value="<?=$cliente[0]->cidade;?>" required=""/>
                        <span class="help-block">Informe a cidade</span>
                    </div>
                </div>
                <!-- Bairro -->
                <div class="col-md-4 form-group">
                    <label for="">Bairro: </label>
                    <div class="has-error" id="div_bairro">
                        <input type="text" name="bairro" class="form-control" id="txtbairro" value="<?=$cliente[0]->bairro;?>" required=""/>
                        <span class="help-block">Informe o Bairro</span>
                    </div>
                </div>
                <!-- Ativo -->
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Ativo: </label>
                        <div class="has-error" id="div_ativo">
                            <select name="ativo" id="txtativo" class="form-control" required="">
                                <option value disabled="true" selected="true">---------</option>
                                <option value="1" <?=$cliente[0]->ativo=='1'?'selected':'';?>>Ativo</option>
                                <option value="0" <?=$cliente[0]->ativo=='0'?'selected':'';?>>Inativo</option>
                            </select>
                            <span class="help-block">Selecione um Status</span>
                        </div>
                    </div>
                </div>
            </div><!-- FIM da ROW -->

            <div class="row">
                <div class="col-md-12 form-group">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="<?=base_url('funcionarioController/clientes');?>" class="btn btn-default">Voltar</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>