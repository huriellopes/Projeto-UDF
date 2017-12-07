<style>
    .panel{
        margin-top: 2%;
    }
</style>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary btn-sm btn-group" onclick="printJS('boleto', 'html');return false;">Imprimir</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-body" id="boleto">
                        <?=$boleto;?>
                    </div>
                </div><!-- final painel -->
            </div>
        </div>

</div>