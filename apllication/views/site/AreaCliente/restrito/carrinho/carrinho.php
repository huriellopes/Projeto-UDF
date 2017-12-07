<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Carrinho de Compra</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <?php echo form_open('carrinhoController/atualizar'); ?>
                <thead>
                    <tr>
                        <th>Quantidade</th>
                        <th>Produto</th>
                        <th>Valor Unitário</th>
                        <th>Total</th>
                        <th>Sub-Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;?>
                    <?php foreach($this->cart->contents() as $items){ ?>
                        <?=form_hidden($i.'[rowid]', $items['rowid']);?>

                        <tr>
                            <td id="qtd">
                                <?=form_input(array('type' => 'number','name' => $i.'[qty]','value' => $items['qty'],'id' => 'qty', 'maxlength' => '3', 'size' => '5'));?>
                            </td>
                            <td>
                                <?=$items['name'];?>

                                <?php if($this->cart->has_options($items['rowid']) == TRUE):?>
                                    <p>
                                        <?php foreach($this->cart->product_options($items['rowid']) as $option_name => $option_value):?>
                                            <strong><?=$option_name;?>:</strong> <?=$option_value; ?></ br>
                                        <?php endforeach;?>
                                    </p>
                                <?php endif;?>
                            </td>
                            
                            <td>R$ <?=$items['price'];?></td>
                            <td id="focus_count">R$ <?=$this->cart->total();?></td>
                            <td id="blur_count">R$ <?=$items['subtotal'];?></td>
                        </tr>
                    <?php $i++;?>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Quantidade</th>
                        <th>Produto</th>
                        <th>Valor Unitário</th>
                        <th>Total</th>
                        <th>Sub-Total</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="<?=base_url('carrinhoController/limpar');?>" class="btn btn-primary btn-group">Limpar o Carrinho</a>
            <a type="submit" href="<?=base_url('carrinhoController/finalizar');?>" style="float:right; margin-left: 5px;" class="btn btn-primary btn-group">Finalizar Compra</a>
            <div style="float: right;"><?php echo form_submit('', 'Atualizar','class="btn btn-primary btn-group"'); ?></div>
        </div>
    </div>
</div>