<link rel="stylesheet" href="<?php echo base_url('public/plugins/iCheck/all.css'); ?>.">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Usuário | Permissões
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('configuracao/usuarios'); ?>"> Usuários</a></li>
            <li class="active">Permissões</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $usuario[0]->nome; ?> - <?php echo $usuario[0]->nome_tipo; ?></h3>
            </div>
            <div class="box-body table-responsive" style="overflow-x: visible;">

                <div class="row">
                    <div class="col-md-6">

                        <?php echo form_open('', 'id="permissao"'); ?>

                        <input type="hidden" name="id" value="<?php if(isset($permissoes)) { echo $permissoes[0]->id; } ?>">
                        <input type="hidden" name="id_usuario" value="<?php echo $usuario[0]->id; ?>">

                        <table class="table table-responsive table-condensed">
                            <tr>
                                <td style="border-top: 0px;">
                                    <label>
                                        <input type="checkbox" class="minimal" id="usuarios" name="usuarios" <?php if(isset($permissoes)) { echo ($permissoes[0]->usuarios == '0') ? '' : 'checked'; } ?>>
                                        Usuários
                                    </label>
                                </td>
                                <td style="border-top: 0px;">
                                    <label>
                                        <input type="checkbox" class="minimal" id="estoque" name="estoque" <?php if(isset($permissoes)) { echo ($permissoes[0]->estoque == '0') ? '' : 'checked'; } ?>>
                                        Estoque
                                    </label>
                                </td>
                                <td style="border-top: 0px;">
                                    <label>
                                        <input type="checkbox" class="minimal" id="documentos" name="documentos" <?php if(isset($permissoes)) { echo ($permissoes[0]->documentos == '0') ? '' : 'checked'; } ?>>
                                        Documentos
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <?php echo form_close(); ?>

                    </div>
                </div>

            </div>

            <div class="box-footer">
                <a type="button" class="btn btn-flat btn-primary" onclick="salvar();">Salvar</a>
            </div>
        </div>

    </section>
</div>

<script>

    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    });

    function salvar() {
        $.ajax({
            url: "<?php echo base_url('configuracao/usuarios/permissao'); ?>",
            type: "POST",
            data: $('#permissao').serialize(),
            success: function () {
                alertify.alert('Mensagem', 'Permissões alteradas com Sucesso', function () {
                    location.href = '<?php echo base_url('configuracao/usuarios'); ?>';
                });
            }
        });
    }

</script>

<script src="<?php echo base_url('public/plugins/iCheck/icheck.min.js'); ?>."></script>
