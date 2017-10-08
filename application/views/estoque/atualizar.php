<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Estoque | Atualizar            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('estoque'); ?>"> Estoque</a></li>
            <li class="active">Atualizar</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">            
            <div class="box-body table-responsive" style="overflow-x: visible;">

                <div class="row">
                    <div class="col-md-6">

                        <?php echo form_open('', 'id="alterar"'); ?>

                        <input type="hidden" value="<?php echo $produto[0]->id; ?>" name="id">

                        <div class="form-group">
                            <label>Produto</label>
                            <input type="text" class="form-control" id="produto" name="produto" placeholder="Produto" value="<?php echo strtoupper($produto[0]->produto); ?>">
                        </div>

                        <div class="form-group">
                            <label>Quantidade</label>
                            <input type="text" class="form-control" id="qtd" name="qtd" placeholder="Quantidade" value="<?php echo $produto[0]->qtd; ?>">
                        </div>

                        <div class="form-group">
                            <label>Patrimônio</label>
                            <input type="text" class="form-control" id="patrimonio" name="patrimonio" placeholder="Patrimônio" value="<?php echo $produto[0]->patrimonio; ?>">
                        </div>

                        <div class="form-group">
                            <label>Caixa</label>
                            <input type="text" class="form-control" id="caixa" name="caixa" placeholder="Caixa" value="<?php echo $produto[0]->caixa; ?>">
                        </div>

                        <div class="form-group">
                            <label>Garantia</label>
                            <input type="text" class="form-control" id="garantia" name="garantia" placeholder="Garantia" value="<?php echo $produto[0]->garantia; ?>">
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

    $(document).ready(function () {
        $('#garantia').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            todayHighlight: true
        });
    });

    function alterar() {

        if ($('#produto').val() === '') {
            alertify.error('Campo Produto Obrigatório');
            return false;
        } else if ($('#qtd').val() === '') {
            alertify.error('Campo Quantidade Obrigatório');
            return false;
        } else {

            $.ajax({
                url: "<?php echo base_url('estoque/update'); ?>",
                type: "POST",
                data: $('#alterar').serialize(),
                success: function ()
                {
                    alertify.alert('Mensagem', 'Produto alterado com Sucesso', function () {
                        location.href = '<?php echo base_url('estoque'); ?>';
                    });
                }
            });
        }
    }

</script>