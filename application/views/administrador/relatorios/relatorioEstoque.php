<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Relatório de Produto</h2>
        </div>    
    </div>
    <div class="row">
        <form action="<?=base_url('administradorController/geraEstoque');?>" method="POST">
            <div class="row">
                <div class="col-md-8 form-group">
                    <div class="input-group input-daterange" id="relatorio">
                        <div class="input-group-addon">Período de</div>
                        <input type="text" name="periodo" id="periodo" class="form-control">
                        <div class="input-group-addon">até</div>
                        <input type="text" name="ate" id="ate" class="form-control"/>
                    </div>
                </div>
            </div><!-- Fim da Row -->
            <div class="row">
                <div class="col-md-12 form-group">
                    <button type="submit" id="btngerar" class="btn btn-primary">Gerar Relatório</button>
                    <button type="reset" class="btn btn-default" style="align:center;">Limpar</button>
                </div>
            </div>
        </form>
    </div>
</div>