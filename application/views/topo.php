<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CMSI | IFPB</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('public/dist/css/AdminLTE.min.css'); ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url('public/dist/css/skins/_all-skins.min.css'); ?>">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?php echo base_url('public/plugins/datepicker/bootstrap-datepicker3.css'); ?>">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url('public/plugins/datatables/dataTables.bootstrap.css'); ?>">
        <!-- Alertify -->
        <link rel="stylesheet" href="<?php echo base_url('public/alertify/css/alertify.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/alertify/css/themes/default.rtl.min.css'); ?>">

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url('public/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
        <!-- Style -->
        <script src="<?php echo base_url('public/style/style.js'); ?>"></script>

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo base_url('home'); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>CMSI</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>CMSI || IFPB</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="hidden-xs"><?php echo $this->session->userdata('usr_nome'); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <p>
                                            <?php echo $this->session->userdata('usr_nome'); ?> - <?php echo $this->session->userdata('usr_tipo'); ?>
                                            <small>Último Acesso: <?php echo $this->session->userdata('usr_ultimo_acesso'); ?></small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="<?php echo base_url('login'); ?>" class="btn btn-default btn-flat">Sair</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>

            <aside class="main-sidebar">
                <section class="sidebar">

                    <ul class="sidebar-menu">

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-pencil"></i> <span>Cadastro</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-down pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">

                                <?php if ($this->session->userdata('perm_estoque') === '1') { ?>
                                <li>
                                    <a href="<?php echo base_url('estoque'); ?>"><i class="fa fa-laptop"></i>
                                        <span> Estoque</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('setor'); ?>"><i class="fa fa-fax"></i>
                                        <span> Setores</span>
                                    </a>
                                </li>
                                <?php } ?>

                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-text-o"></i> <span>Documentos</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-down pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">

                                <?php if ($this->session->userdata('perm_documentos') === '1') { ?>

                                <li>
                                    <a href="<?php echo base_url('ordem_servico'); ?>"><i class="fa fa-wrench"></i>
                                        <span> Ordem de Serviço</span>
                                    </a>
                                </li>

                                <?php } ?>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cog"></i> <span>Configurações</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-down pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-book"></i> Log</a></li>

                                <?php if ($this->session->userdata('perm_usuarios') === '1') { ?>
                                    <li><a href="<?php echo base_url('configuracao/usuarios'); ?>"><i class="fa fa-user"></i>
                                            Usuários</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>

                </section>

            </aside>
