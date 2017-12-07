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
            <h2>Relatório de Vendas</h2>
            <p>Período de: <?=$periodo = $this->input->post('periodo');?> até <?=$ate = $this->input->post('ate');?></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="detalhes" align="center">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-Mail</th>
                            <th>Telefone</th>
                            <th>Código</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                            <th>Forma de Pagamento</th>
                        </tr>
                    </thead>
                    <?php if(0 < count($venda)){?>
                    <tbody>
                        <?php
                            foreach($venda as $vendas){
                                echo "<tr>";
                                echo "<td>" . $vendas['nomeCliente'] . "</td>";
                                echo "<td>" . $vendas['CpfCnpj'] . "</td>";
                                echo "<td>" . $vendas['email'] . "</td>";
                                echo "<td>" . $vendas['telefone'] . "</td>";
                                echo "<td>" . $vendas['cod_produto'] . "</td>";
                                echo "<td>" . $vendas['nomeProduto'] . "</td>";
                                echo "<td>" . $vendas['quantidade'] . "</td>";
                                echo "<td>" . formata_preco($vendas['valor']) . "</td>";
                                echo "<td>" . $vendas['forma'] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <?php echo "<div class='total'> <p> Total de Registros de Vendas: " . count($venda) . '</p> </div>';?>
                <?php
                    }else{
                        echo "Não há vendas!";
                    }
                ?>
            </div>
        </div>
    </div>