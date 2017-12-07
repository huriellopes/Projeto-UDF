<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Atualizar Fornecedor</h2>
        </div>
    </div><!-- Fim da Row -->

    <div class="row">
        <form action="<?=base_url('administradorController/atualizaFornecedor');?>" method="POST">
            
            <div class="row">
                <input type="hidden" id="idfornecedor" name="idfornecedor" value="<?=$fornecedor[0]->idfornecedor;?>">
                <!-- Nome Fantasia -->
                <div class="col-md-6 form-group">
                    <label for="">Nome Fantasia: </label>
                    <div class="has-error" id="div_nomeFantasia">
                        <input type="text" name="nomeFantasia" class="form-control" id="txtnomefantasia" value="<?=$fornecedor[0]->nomeFantasia;?>" autofocus required=""/>
                        <span class="help-block">Informe o Nome Fantasia</span>
                    </div>
                </div>
                <!-- Razão Social -->
                <div class="col-md-6 form-group">
                    <label for="">Razão Social: </label>
                    <div class="has-error" id="div_razaoSocial">
                        <input type="text" name="razaoSocial" class="form-control" id="txtrazaosocial" value="<?=$fornecedor[0]->razaoSocial;?>" required=""/>
                        <span class="help-block">Informe a Razão Social</span>
                    </div>
                </div>
            </div><!-- FIM da ROW -->

            <div class="row">
                <!-- CNPJ -->
                <div class="col-md-6 form-group">
                    <label for="">CNPJ: </label>
                    <div class="has-error" id="div_cnpj">
                        <input type="text" name="cnpj" class="form-control" value="<?=$fornecedor[0]->cnpj;?>" id="txtcnpj" required=""/>
                        <span class="help-block">Informe o CNPJ</span>
                    </div>
                </div>
                <!-- Data da Criação da Empresa -->
                <div class="col-md-6 form-group">
                    <label for="">Data de Criação: </label>
                    <div class="has-error" id="div_data">
                        <input type="text" name="dataCriacao" class="form-control" value="<?=date('d/m/Y',strtotime(str_replace('-','/',$fornecedor[0]->dataCriacao)));?>" id="data" required=""/>
                        <span class="help-block">Informe a data de criação</span>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="row">
                <!-- E-mail da empresa -->
                <div class="col-md-6 form-group">
                    <label for="">E-Mail: </label>
                    <div class="has-error" id="div_email">
                        <input type="text" name="email" class="form-control" value="<?=$fornecedor[0]->email;?>" id="txtemail" required=""/>
                        <span class="help-block">Informe um E-Mail</span>
                    </div>
                </div>
                <!-- Telefone de Contato da Empresa -->
                <div class="col-md-6 form-group">
                    <label for="">Telefone: </label>
                    <div class="has-error" id="div_fone">
                        <input type="text" name="telefone" class="form-control" value="<?=$fornecedor[0]->telefone;?>" id="txtfone" required=""/>
                        <span class="help-block">Informe um Telefone</span>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="row">
                <!-- Endereço da Empresa -->
                <div class="col-md-9 form-group">
                    <label for="">Endereço: </label>
                    <div class="has-error" id="div_endereco">
                        <input type="text" name="endereco" class="form-control" value="<?=$fornecedor[0]->endereco;?>" id="txtendereco" required=""/>
                        <span class="help-block">Informe um Endereço</span>
                    </div>
                </div>
                <!-- Número -->
                <div class="col-md-3 form-group">
                    <label for="">N°.:</label>
                    <div class="has-error" id="div_numero">
                        <input type="text" name="numero" class="form-control" value="<?=$fornecedor[0]->numero;?>" id="txtnumero" required=""/>
                        <span class="help-block">N°</span>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="row">
                <!-- Complemento do endereço da empresa -->
                <div class="col-md-6 form-group">
                    <label for="">Complemento: </label>
                    <input type="text" name="complemento" class="form-control" value="<?=$fornecedor[0]->complemento;?>"/>
                    <span class="help-block">Informe o Complemento do Endereço</span>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">CEP.: </label>
                    <div class="has-error" id="div_cep">
                        <input type="text" name="cep" class="form-control" value="<?=$fornecedor[0]->cep;?>" id="txtcep" required=""/>
                        <span class="help-block">Informe o CEP</span>
                    </div>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">UF.:</label>
                    <div class="has-error" id="div_uf">
                        <select name="uf" id="txtuf" class="form-control">
                            <option value disabled="true" selected="true">Selecione a UF</option>
                            <option value="AL" <?=$fornecedor[0]->uf=='AL'?'selected':'';?>>AL</option>
                            <option value="AM" <?=$fornecedor[0]->uf=='AM'?'selected':'';?>>AM</option>
                            <option value="AP" <?=$fornecedor[0]->uf=='AP'?'selected':'';?>>AP</option>
                            <option value="BA" <?=$fornecedor[0]->uf=='BA'?'selected':'';?>>BA</option>
                            <option value="CE" <?=$fornecedor[0]->uf=='CE'?'selected':'';?>>CE</option>
                            <option value="DF" <?=$fornecedor[0]->uf=='DF'?'selected':'';?>>DF</option>
                            <option value="ES" <?=$fornecedor[0]->uf=='ES'?'selected':'';?>>ES</option>
                            <option value="GO" <?=$fornecedor[0]->uf=='GO'?'selected':'';?>>GO</option>
                            <option value="MA" <?=$fornecedor[0]->uf=='MA'?'selected':'';?>>MA</option>
                            <option value="MG" <?=$fornecedor[0]->uf=='MG'?'selected':'';?>>MG</option>
                            <option value="MS" <?=$fornecedor[0]->uf=='MS'?'selected':'';?>>MS</option>
                            <option value="MT" <?=$fornecedor[0]->uf=='MT'?'selected':'';?>>MT</option>
                            <option value="PA" <?=$fornecedor[0]->uf=='PA'?'selected':'';?>>PA</option>
                            <option value="PB" <?=$fornecedor[0]->uf=='PB'?'selected':'';?>>PB</option>
                            <option value="PE" <?=$fornecedor[0]->uf=='PE'?'selected':'';?>>PE</option>
                            <option value="PI" <?=$fornecedor[0]->uf=='PI'?'selected':'';?>>PI</option>
                            <option value="PR" <?=$fornecedor[0]->uf=='PR'?'selected':'';?>>PR</option>
                            <option value="RJ" <?=$fornecedor[0]->uf=='RJ'?'selected':'';?>>RJ</option>
                            <option value="RN" <?=$fornecedor[0]->uf=='RN'?'selected':'';?>>RN</option>
                            <option value="RO" <?=$fornecedor[0]->uf=='RO'?'selected':'';?>>RO</option>
                            <option value="RR" <?=$fornecedor[0]->uf=='RR'?'selected':'';?>>RR</option>
                            <option value="RS" <?=$fornecedor[0]->uf=='RS'?'selected':'';?>>RS</option>
                            <option value="SC" <?=$fornecedor[0]->uf=='SC'?'selected':'';?>>SC</option>
                            <option value="SE" <?=$fornecedor[0]->uf=='SE'?'selected':'';?>>SE</option>
                            <option value="SP" <?=$fornecedor[0]->uf=='SP'?'selected':'';?>>SP</option>
                            <option value="TO" <?=$fornecedor[0]->uf=='TO'?'selected':'';?>>TO</option>
                        </select>
                        <span class="help-block">Informe a UF</span>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="row">                
                <!-- Cidade -->
                <div class="col-md-4 form-group">
                    <label for="">Cidade: </label>
                    <div class="has-error" id="div_cidade">
                        <input type="text" name="cidade" class="form-control" value="<?=$fornecedor[0]->cidade;?>" id="txtcidade" required=""/>
                        <span class="help-block">Informe a cidade</span>
                    </div>
                </div>
                <!-- Bairro -->
                <div class="col-md-4 form-group">
                    <label for="">Bairro: </label>
                    <div class="has-error" id="div_bairro">
                        <input type="text" name="bairro" class="form-control" value="<?=$fornecedor[0]->bairro;?>" id="txtbairro" required=""/>
                        <span class="help-block">Informe o Bairro</span>
                    </div>
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Ativo: </label>
                    <div class="has-error" id="div_ativo">
                        <select name="ativo" id="txtativo" class="form-control" required="">
                        <option value disabled="true" selected="true">Selecione o Status</option>
                            <option value="1" <?=$fornecedor[0]->ativo=='1'?'selected':'';?>>Ativo</option>
                            <option value="0" <?=$fornecedor[0]->ativo=='0'?'selected':'';?>>Inativo</option>
                        </select>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="row">
                <div class="col-md-12 form-group">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="<?=base_url('administradorController/fornecedores');?>" class="btn btn-default">Voltar</a>
                </div>
            </div><!-- Fim da Row -->

        </form><!-- FIM do FORM -->
    </div><!-- FIM da ROW -->
</div>