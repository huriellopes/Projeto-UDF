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
            <h2>Relatório de Clientes</h2>
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
                            <th>CNPJ</th>
                            <th>Tipo</th>
                            <th>Nascimento</th>
                            <th>E-Mail</th>
                            <th>Sexo</th>
                            <th>Telefone</th>
                            <th>UF</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php if(!empty($cliente)){?>
                    <?php 
                        foreach($cliente as $clientes){
                            $nome           = $clientes['nomeCliente'];
                            $cpf            = $clientes['Cpf'];
                            $cnpj           = $clientes['Cnpj'];
                            $tipo           = $clientes['tipo'];
                            $nascimento     = $clientes['nascimentoCliente'];
                            $email          = $clientes['email'];
                            $sexo           = $clientes['sexo'];
                            $telefone       = $clientes['telefone'];
                            $uf             = $clientes['uf'];
                            $status         = $clientes['ativo'];
                    ?>
                    <tbody>
                        <tr>
                            <td><?=$nome;?></td>
                            <td><?=$cpf;?></td>
                            <td><?=$cnpj;?></td>
                            <td><?=$tipo;?></td>
                            <td><?=$nascimento;?></td>
                            <td><?=$email;?></td>
                            <td><?=$sexo==$sexo?$sexo:$sexo;?></td>
                            <td><?=$telefone;?></td>
                            <td><?=$uf==$uf?$uf:$uf;?></td>
                            <td><?=$status=='1'?'Ativo':'Inativo';?></td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
                <?php echo "<div class='total'> <p> Total de Clientes: " . count($cliente) . '</p> </div>';?>
                <?php
                    }else{
                        echo "Não há registros!";
                    }
                ?>
            </div>
        </div>
    </div>