<style>
    table#tb_estoque tr td .hoverbutton {
        visibility: hidden;
    }

    table#tb_estoque tr:hover td .hoverbutton {
        visibility: visible
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Lista de Setores
            <small>Setores</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Setores</li>
        </ol>
    </section>

    <section class="content">
        <div class="pad">
            <a href="<?php echo base_url('setor/novo'); ?>" type="button" class="btn btn-primary btn-flat">Novo Setor</a>
        </div>   
        <div class="box box-primary">
            <div class="box-body table-responsive" style="overflow-x: visible;">
                <table id="tb_setor" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Sigla</th>
                            <th>Setor</th>
                            <th>Ramal</th>
                            <th>Responsável</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($setor as $value) { ?>
                        <tr id="<?php echo $value->id; ?>">
                                <td style="width: 5%">
                                    <div class="input-group-btn hoverbutton">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">Ações
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu" style="min-width: 50%;">
                                            <li>
                                                <a href="<?php echo base_url("setor/atualizar/$value->id"); ?>">Atualizar</a>
                                            </li>
                                            <li><a onclick="excluir('<?php echo $value->id; ?>');">Excluir</a></li>                                            
                                        </ul>
                                    </div>
                                </td>
                                <td><?php echo $value->sigla; ?></td>
                                <td><?php echo $value->setor; ?></td>
                                <td><?php echo $value->ramal; ?></td>
                                <td><?php echo $value->responsavel; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Sigla</th>
                            <th>Setor</th>
                            <th>Ramal</th>
                            <th>Responsável</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
    $(function () {
        $("#tb_setor").DataTable({
            "language": {
                "url": "<?php echo base_url('public/plugins/datatables/i18n/pt-br.json.js'); ?>"
            },
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
    });

    function excluir(id) {
        alertify.confirm().set('labels', {ok: 'SIM', cancel: 'NÃO'});
        alertify.confirm('Mensagem', 'Realmente deseja excluir esse Setor?', function () {
            $.ajax({
                url: "<?php echo base_url('setor/excluir'); ?>",
                type: "POST",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', "id": id},
                success: function () {
                    alertify.success('Setor excluído com Sucesso');
                    $('#' + id).remove();
                }
            });
        }
        , function () {

        });
    }

</script>