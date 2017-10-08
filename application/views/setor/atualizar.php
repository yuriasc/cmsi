<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Setor | Atualizar            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('setor'); ?>"> Setor</a></li>
            <li class="active">Atualizar</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">            
            <div class="box-body table-responsive" style="overflow-x: visible;">

                <div class="row">
                    <div class="col-md-6">

                        <?php echo form_open('', 'id="alterar"'); ?>

                        <input type="hidden" value="<?php echo $setor[0]->id; ?>" name="id">

                        <div class="form-group">
                            <label>Sigla</label>
                            <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Sigla" value="<?php echo $setor[0]->sigla; ?>">
                        </div>

                        <div class="form-group">
                            <label>Setor</label>
                            <input type="text" class="form-control" id="setor" name="setor" placeholder="Setor" value="<?php echo $setor[0]->setor; ?>">
                        </div>

                        <div class="form-group">
                            <label>Ramal</label>
                            <input type="text" class="form-control" id="ramal" name="ramal" placeholder="Ramal" value="<?php echo $setor[0]->ramal; ?>">
                        </div>

                        <div class="form-group">
                            <label>Responsável</label>
                            <input type="text" class="form-control" id="responsavel" name="responsavel" placeholder="Responsável" value="<?php echo $setor[0]->responsavel; ?>">
                        </div>

                        <?php echo form_close(); ?>

                    </div>
                </div>

            </div>

            <div class="box-footer">
                <a type="button" class="btn btn-flat btn-primary" onclick="return alterar();">Atualizar</a>
            </div>
        </div>

    </section>
</div>

<script>

    function alterar() {

        if ($('#sigla').val() === '') {
            alertify.error('Campo Sigla Obrigatório');
            return false;
        } else if ($('#setor').val() === '') {
            alertify.error('Campo Setor Obrigatório');
            return false;
        } else {

            $.ajax({
                url: "<?php echo base_url('setor/update'); ?>",
                type: "POST",
                data: $('#alterar').serialize(),
                success: function ()
                {
                    alertify.alert('Mensagem', 'Setor alterado com Sucesso', function () {
                        location.href = '<?php echo base_url('setor'); ?>';
                    });
                }
            });
        }
    }

</script>