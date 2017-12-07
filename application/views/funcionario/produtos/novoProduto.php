<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Novo Produto</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <strong>Atenção! Os campos em vermelho são Obrigatórios!</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="<?=base_url('funcionarioController/InsereProduto');?>" method="POST" id="form">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Código Produto:</label>
                        <div class="has-error" id="div_codigo">
                            <input type="text" id="codProduto" name="cod_produto" class="form-control" autofocus/>
                            <span class="help-block">Informe o Código do Produto</span>
                        </div>
                    </div>
                    <div class="col-md-8 form-group">
                        <label for="">Produto:</label>
                        <div class="has-error" id="div_nomeproduto">
                            <input type="text" name="nomeProduto" id="nomeProduto" class="form-control"/>
                            <span class="help-block">Informe o Nome do Produto</span>
                        </div>
                    </div>
                </div><!-- Fim da Row -->
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Data de Validade: </label>
                        <div class="has-error" id="div_Data">
                            <input type="text" class="form-control" name="validade" id="txtdata"/>
                            <span class="help-block">Informe uma Data de Validade!</span>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Quantidade: </label>
                        <div class="has-error" id="div_quantidade">
                            <input type="text" name="quantidade" id="txtquantidade" class="form-control"/>
                            <span class="help-block">Informe a quantidade do produto</span>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Descrição: </label>
                        <div class="has-error" id="div_desc">
                            <input type="text" name="descricao" id="txtdesc" class="form-control"/>
                            <span class="help-block">Informe uma breve descrição</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Valor Unitário: </label>
                        <div class="has-error" id="div_valor">
                            <input type="text" name="valor" class="form-control" required="" id="txtvalor"/>
                            <span class="help-block">Informe o valor unitário</span>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Categoria: </label>
                        <div class="has-error" id="div_categoria">
                            <select name="id_categoria" id="selcategoria" class="form-control">
                                <option value disabled="true" selected="true">---------</option>
                                <?php foreach($categoria as $categorias):?>
                                    <option value="<?=$categorias->idcategoria?>"><?=$categorias->nomeCategoria?></option>
                                <?php endforeach;?>
                            </select>
                            <span class="help-block">Informe a categoria</span>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Fornecedor: </label>
                        <div class="has-error" id="div_fornecedor">
                            <select name="id_fornecedor" id="selfornecedor" class="form-control">
                            <option value disabled="true" selected="true">---------</option>
                            <?php foreach($fornecedor as $fornecedores):?>
                                <option value="<?=$fornecedores->idfornecedor;?>"><?=$fornecedores->nomeFantasia;?></option>
                            <?php endforeach;?>
                            </select>
                            <span class="help-block">Informe o fornecedor do produto</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <a href="<?=base_url('funcionarioController/produtos');?>" onclick="return confirm('Deseja Voltar?');" class="btn btn-default">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>