<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de Gerenciamento de Clientes"/>
    <meta name="author" content="Huriel Correia Lopes"/>
	<title>Site - Seu negócio sobControle</title>
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css'); ?>"/>
    <link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>"/>
    <link rel="stylesheet" href="<?=base_url('assets/css/ie10-viewport-bug-workaround.css'); ?>"/>
    <link rel="stylesheet" href="<?=base_url('assets/sweetAlert/css/sweetalert.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/datables/media/css/dataTables.bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/jquery.dataTables.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/print.min.css');?>">        
    <script src="<?=base_url('assets/js/ie-emulation-modes-warning.js'); ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .up,.dn{ cursor:pointer; border:1px solid #e0e0e0;width: 20px;text-align: center;float: left;height: 27px;line-height: 27px; color:#666;}
        .up:hover,.dn:hover{ background:#666; color:#fff; border-color:#666;}
        .dn{border-right:none;}
        .up{border-left:none;}
        #qty{-webkit-border-radius: 0;border-radius:0; text-align:center;}
    </style>
</head>
<body>
    <div class="container-fluid">
    