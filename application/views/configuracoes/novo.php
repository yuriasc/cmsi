<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Usuário | Novo            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('configuracao/usuarios'); ?>"> Usuários</a></li>
            <li class="active">Novo</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">            
            <div class="box-body table-responsive" style="overflow-x: visible;">

                <div class="row">
                    <div class="col-md-6">

                        <?php echo form_open('', 'id="novo"'); ?>

                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required="">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                        </div>  

                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="form-control" id="tipo" name="tipo">
                                <option value="">Selecione um Tipo... </option>
                                <?php foreach ($tipos as $value) { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->nome; ?></option>
                                <?php } ?>
                            </select>
                        </div> 

                        <?php echo form_close(); ?>

                    </div>
                </div>

            </div>

            <div class="box-footer">
                <a type="button" class="btn btn-flat btn-primary" onclick="return novo();">Salvar</a>
            </div>
        </div>

    </section>
</div>

<script>

    function novo() {
        
        if ($('#nome').val() === '') {
            alertify.error('Campo Nome Obrigatório');
            return false;
        } else if ($('#email').val() === '') {
            alertify.error('Campo Email Obrigatório');
            return false;
        } else if ($('#senha').val() === '') {
            alertify.error('Campo Senha Obrigatório');
            return false;
        } else if ($('#tipo').val() === '') {
            alertify.error('Campo Tipo Obrigatório');
            return false;
        } else {

            $.ajax({
                url: "<?php echo base_url('configuracao/usuarios/save'); ?>",
                type: "POST",
                data: $('#novo').serialize(),
                success: function () {
                    alertify.alert('Mensagem', 'Usuário criado com Sucesso', function () {
                        location.href = '<?php echo base_url('configuracao/usuarios'); ?>';
                    });
                }
            });
        }
    }

</script>