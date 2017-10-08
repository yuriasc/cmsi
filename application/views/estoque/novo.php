<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Estoque | Novo            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('estoque'); ?>"> Estoque</a></li>
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
                            <label>Produto</label>
                            <input type="text" class="form-control" id="produto" name="produto" placeholder="Produto">
                        </div>

                        <div class="form-group">
                            <label>Quantidade</label>
                            <input type="text" class="form-control" id="qtd" name="qtd" placeholder="Quantidade">
                        </div>

                        <div class="form-group">
                            <label>Patrimônio</label>
                            <input type="text" class="form-control" id="patrimonio" name="patrimonio" placeholder="Patrimônio">
                        </div>

                        <div class="form-group">
                            <label>Caixa</label>
                            <input type="text" class="form-control" id="caixa" name="caixa" placeholder="Caixa">
                        </div>

                        <div class="form-group">
                            <label>Garantia</label>
                            <input type="text" class="form-control" id="garantia" name="garantia" placeholder="Garantia">
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

    $(document).ready(function () {
        $('#garantia').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            todayHighlight: true
        });
    });

    function novo() {

        if ($('#produto').val() === '') {
            alertify.error('Campo Produto Obrigatório');
            return false;
        } else if ($('#qtd').val() === '') {
            alertify.error('Campo Quantidade Obrigatório');
            return false;
        } else {

            $.ajax({
                url: "<?php echo base_url('estoque/save'); ?>",
                type: "POST",
                data: $('#novo').serialize(),
                success: function () {
                    alertify.alert('Mensagem', 'Produto cadastrado com Sucesso', function () {
                        location.href = '<?php echo base_url('estoque'); ?>';
                    });
                }
            });
        }
    }

</script>