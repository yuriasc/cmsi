<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CMSI | IFPB</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--FavIcon-->
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('public/dist/img/favicon.png'); ?>">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('public/dist/css/AdminLTE.min.css'); ?>">        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>    
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>CMSI</b>IFPB</a>
            </div>            
            <div class="login-box-body">
                <p class="login-box-msg">Faça Login para iniciar sua sessão</p>

                <?php echo form_open('login/acesso'); ?>

                <div class="form-group has-feedback">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="senha" placeholder="Senha">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">                        
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                </div>
                <?php echo form_close(); ?>

                <?php if ($this->session->flashdata('erro')) { ?>
                    <div class="alert alert-danger" style="margin-top: 20px;">   
                        <?php echo $this->session->flashdata('erro'); ?>
                    </div>
                <?php } ?>

            </div>
        </div>

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url('public/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js'); ?>"></script>        

        <script>
            $(document).ready(function () {
                $('#email').focus();

                $('input').on('click', function () {
                    $('.alert').fadeOut('slow');
                });
            });
        </script>
    </body>
</html>
