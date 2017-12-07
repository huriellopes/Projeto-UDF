    <style>
        .info{
            text-align: center;
        }

        .info h2{
            font-size: 1.2em;
            font-weight: bold;
        }

        .info p{
            font-weight: 600;
            font-size: 1em;
        }

        .detalhes{
            border-collapse: collapse;
            width:100%;
        }

        .detalhes th{
            background-color:#eeeeee;
            border:1px solid #cccccc;
            vertical-align:top;
            padding:5px;
        }

        .detalhes td{
            border:1px solid #cccccc;
            vertical-align:top;
            padding:5px;
        }
        .total{
            text-align: right;
            font-size: 0.95em;
            font-weight: 800;
        }
    </style>
    <div class="info">
        <div class="container">
            <h2>Relatório de Estoque/Produtos</h2>
            <p>Período de: <?=$periodo = $this->input->post('periodo');?> até <?=$ate = $this->input->post('ate');?></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="detalhes" align="center">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                            <th>Categoria</th>
                            <th>Fornecedor</th>
                        </tr>
                    </thead>
                    <?php if(!empty($estoque)){?>
                    <?php
                        foreach($estoque as $produto){
                            $codigo         = $produto['cod_produto'];
                            $nome           = $produto['nomeProduto'];
                            $quantidade     = $produto['quantidade'];
                            $valor          = $produto['valor'];
                            $id_categoria   = $produto['id_categoria'];
                            $idcategoria    = $produto['idcategoria'];
                            $categoria      = $produto['nomeCategoria'];
                            $id_fornecedor  = $produto['id_fornecedor'];
                            $idfornecedor   = $produto['idfornecedor'];
                            $fornecedor     = $produto['nomeFantasia'];
                    ?>
                    <tbody>
                        <tr>
                            <td><?=$codigo;?></td>
                            <td><?=$nome;?></td>
                            <td><?=$quantidade;?></td>
                            <td><?=$valor;?></td>
                            <td><?=$id_categoria==$idcategoria?$categoria:$categoria;?></td>
                            <td><?=$id_fornecedor==$idfornecedor?$fornecedor:$fornecedor;?></td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
                <?php echo "<div class='total'> <p> Total de Produtos: " . count($estoque) . '</p> </div>';?>
                <?php 
                    }else{
                        echo "Não há registros!";
                    }
                ?>
            </div>
        </div>
    </div>