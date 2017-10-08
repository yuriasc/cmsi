<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Setor | Novo            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('setor'); ?>"> Setor</a></li>
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
                            <label>Sigla</label>
                            <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Sigla">
                        </div>

                        <div class="form-group">
                            <label>Setor</label>
                            <input type="text" class="form-control" id="setor" name="setor" placeholder="Setor">
                        </div>

                        <div class="form-group">
                            <label>Ramal</label>
                            <input type="text" class="form-control" id="ramal" name="ramal" placeholder="Ramal">
                        </div>

                        <div class="form-group">
                            <label>Responsável</label>
                            <input type="text" class="form-control" id="responsavel" name="responsavel" placeholder="Responsável">
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

        if ($('#sigla').val() === '') {
            alertify.error('Campo Sigla Obrigatório');
            return false;
        } else if ($('#setor').val() === '') {
            alertify.error('Campo Setor Obrigatório');
            return false;
        } else {

            $.ajax({
                url: "<?php echo base_url('setor/save'); ?>",
                type: "POST",
                data: $('#novo').serialize(),
                success: function () {
                    alertify.alert('Mensagem', 'Setor cadastrado com Sucesso', function () {
                        location.href = '<?php echo base_url('setor'); ?>';
                    });
                }
            });
        }
    }

</script>