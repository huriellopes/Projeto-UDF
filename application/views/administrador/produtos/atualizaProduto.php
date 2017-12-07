<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Atualizar Produto</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="<?=base_url('administradorController/AtualizaProd');?>" method="POST" id="form">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input type="hidden" name="idProduto" value="<?=$produto[0]->idProduto;?>">
                        <label for="">Código Produto:</label>
                        <div class="has-error" id="div_codigo">
                            <input type="text" id="codProduto" name="cod_produto" value="<?=$produto[0]->cod_produto;?>" class="form-control" autofocus required=""/>
                            <span class="help-block">Informe o Código do Produto</span>
                        </div>
                    </div>
                    <div class="col-md-8 form-group">
                        <label for="">Produto:</label>
                        <div class="has-error" id="div_nomeproduto">
                            <input type="text" name="nomeProduto" id="nomeProduto" value="<?=$produto[0]->nomeProduto;?>" class="form-control"/>
                            <span class="help-block">Informe o Nome do Produto</span>
                        </div>
                    </div>
                </div><!-- Fim da Row -->
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Data de Validade: </label>
                        <div class="has-error" id="div_Data">
                            <input type="text" class="form-control" name="validade" value="<?=date('d/m/Y',strtotime(str_replace('-','/',$produto[0]->validade)));?>" id="txtdata" required=""/>
                            <span class="help-block">Informe uma Data de Validade!</span>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Quantidade: </label>
                        <div class="has-error" id="div_quantidade">
                            <input type="text" name="quantidade" id="txtquantidade" value="<?=$produto[0]->quantidade;?>" class="form-control" required=""/>
                            <span class="help-block">Informe a quantidade do produto</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Descrição: </label>
                        <div class="has-error" id="div_desc">
                            <input type="text" name="descricao" id="txtdesc" value="<?=$produto[0]->descricao;?>" class="form-control" required=""/>
                            <span class="help-block">Informe uma breve descrição</span>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Categoria: </label>
                        <div class="has-error" id="div_categoria">
                            <select name="id_categoria" id="selcategoria" class="form-control" required="">
                                <option value disabled="true" selected="true">---------</option>
                                <?php foreach($categoria as $categorias):?>
                                    <option value="<?=$categorias->idcategoria?>"<?=$produto[0]->id_categoria==$categorias->idcategoria?'selected':'';?>><?=$categorias->nomeCategoria?></option>
                                <?php endforeach;?>
                            </select>
                            <span class="help-block">Informe a categoria</span>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Fornecedor: </label>
                        <div class="has-error" id="div_fornecedor">
                            <select name="id_fornecedor" id="selfornecedor" class="form-control" required="">
                            <option value disabled="true" selected="true">---------</option>
                            <?php foreach($fornecedor as $fornecedores):?>
                                <option value="<?=$fornecedores->idfornecedor;?>" <?=$produto[0]->id_fornecedor==$fornecedores->idfornecedor?'selected':'';?>><?=$fornecedores->nomeFantasia;?></option>
                            <?php endforeach;?>
                            </select>
                            <span class="help-block">Informe o fornecedor do produto</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <a href="<?=base_url('administradorController/produtos');?>" onclick="return confirm('Deseja Voltar?');" class="btn btn-default">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>