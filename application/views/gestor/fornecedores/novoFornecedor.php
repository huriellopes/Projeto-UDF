<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Novo Fornecedor</h2>
        </div>
    </div><!-- Fim da Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <strong>Atenção! Os campos em vermelho são Obrigatórios!</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <form action="<?=base_url('gestorController/insereFornecedor');?>" method="POST">
            
            <div class="form-row">
                <!-- Nome Fantasia -->
                <div class="col-md-6 form-group">
                    <label for="">Nome Fantasia: </label>
                    <div class="has-error" id="div_nomeFantasia">
                        <input type="text" name="nomeFantasia" class="form-control" id="txtnomefantasia" autofocus required=""/>
                        <span class="help-block">Informe o Nome Fantasia</span>
                    </div>
                </div>
                <!-- Razão Social -->
                <div class="col-md-6 form-group">
                    <label for="">Razão Social: </label>
                    <div class="has-error" id="div_razaoSocial">
                        <input type="text" name="razaoSocial" class="form-control" id="txtrazaosocial" required=""/>
                        <span class="help-block">Informe a Razão Social</span>
                    </div>
                </div>
            </div><!-- FIM da ROW -->

            <div class="form-row">
                <!-- CNPJ -->
                <div class="col-md-6 form-group">
                    <label for="">CNPJ: </label>
                    <div class="has-error" id="div_cnpj">
                        <input type="text" name="cnpj" class="form-control" id="txtcnpj" required=""/>
                        <span class="help-block">Informe o CNPJ</span>
                    </div>
                </div>
                <!-- Data da Criação da Empresa -->
                <div class="col-md-6 form-group">
                    <label for="">Data de Criação: </label>
                    <div class="has-error" id="div_data">
                        <input type="text" name="dataCriacao" class="form-control" id="data" required=""/>
                        <span class="help-block">Informe a data de criação</span>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="form-row">
                <!-- E-mail da empresa -->
                <div class="col-md-6 form-group">
                    <label for="">E-Mail: </label>
                    <div class="has-error" id="div_email">
                        <input type="text" name="email" class="form-control" id="txtemail"/>
                        <span class="help-block">Informe um E-Mail</span>
                    </div>
                </div>
                <!-- Telefone de Contato da Empresa -->
                <div class="col-md-6 form-group">
                    <label for="">Telefone: </label>
                    <div class="has-error" id="div_fone">
                        <input type="text" name="telefone" class="form-control" id="txtfone"/>
                        <span class="help-block">Informe um Telefone</span>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="form-row">
                <!-- Endereço da Empresa -->
                <div class="col-md-9 form-group">
                    <label for="">Endereço: </label>
                    <div class="has-error" id="div_endereco">
                        <input type="text" name="endereco" class="form-control" id="txtendereco"/>
                        <span class="help-block">Informe um Endereço</span>
                    </div>
                </div>
                <!-- Número -->
                <div class="col-md-3 form-group">
                    <label for="">N°.:</label>
                    <div class="has-error" id="div_numero">
                        <input type="text" name="numero" class="form-control" id="txtnumero"/>
                        <span class="help-block">N°</span>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="form-row">
                <!-- Complemento do endereço da empresa -->
                <div class="col-md-6 form-group">
                    <label for="">Complemento: </label>
                    <input type="text" name="complemento" class="form-control"/>
                    <span class="help-block">Informe o Complemento do Endereço</span>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">CEP.: </label>
                    <div class="has-error" id="div_cep">
                        <input type="text" name="cep" class="form-control" id="txtcep"/>
                        <span class="help-block">Informe o CEP</span>
                    </div>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">UF.:</label>
                    <div class="has-error" id="div_uf">
                        <select name="uf" id="txtuf" class="form-control">
                            <option value disabled="true" selected="true">Selecione a UF</option>
                            <option value="AL">AL</option>
                            <option value="AM">AM</option>
                            <option value="AP">AP</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MG">MG</option>
                            <option value="MS">MS</option>
                            <option value="MT">MT</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="PR">PR</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="RS">RS</option>
                            <option value="SC">SC</option>
                            <option value="SE">SE</option>
                            <option value="SP">SP</option>
                            <option value="TO">TO</option>
                        </select>
                        <span class="help-block">Informe a UF</span>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="form-row">                
                <!-- Cidade -->
                <div class="col-md-4 form-group">
                    <label for="">Cidade: </label>
                    <div class="has-error" id="div_cidade">
                        <input type="text" name="cidade" class="form-control" id="txtcidade"/>
                        <span class="help-block">Informe a cidade</span>
                    </div>
                </div>
                <!-- Bairro -->
                <div class="col-md-4 form-group">
                    <label for="">Bairro: </label>
                    <div class="has-error" id="div_bairro">
                        <input type="text" name="bairro" class="form-control" id="txtbairro"/>
                        <span class="help-block">Informe o Bairro</span>
                    </div>
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Ativo: </label>
                    <div class="has-error" id="div_ativo">
                        <select name="ativo" id="txtativo" class="form-control">
                        <option value disabled="true" selected="true">Selecione o Status</option>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                </div>
            </div><!-- Fim da Row -->

            <div class="form-row">
                <div class="col-md-12 form-group">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="<?=base_url('gestorController/fornecedores');?>" class="btn btn-default">Voltar</a>
                </div>
            </div><!-- Fim da Row -->

        </form><!-- FIM do FORM -->
    </div><!-- FIM da ROW -->
</div>