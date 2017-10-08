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
            Estoque de Produtos
            <small>Painel de Controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Estoque</li>
        </ol>
    </section>

    <section class="content">
        <div class="pad">
            <a href="<?php echo base_url('estoque/novo'); ?>" type="button" class="btn btn-primary btn-flat">Novo Produto</a>
        </div>   
        <div class="box box-primary">
            <div class="box-body table-responsive" style="overflow-x: visible;">
                <table id="tb_estoque" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Produto</th>
                            <th>QTD</th>
                            <th>Patrimônio</th>
                            <th>Caixa</th>
                            <th>Garantia</th>
                            <th>Entrada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estoque as $value) { ?>
                        <tr id="<?php echo $value->id; ?>">
                                <td style="width: 5%">
                                    <div class="input-group-btn hoverbutton">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">Ações
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu" style="min-width: 50%;">
                                            <li>
                                                <a href="<?php echo base_url("estoque/atualizar/$value->id"); ?>">Atualizar</a>
                                            </li>
                                            <li><a onclick="excluir('<?php echo $value->id; ?>');">Excluir</a></li>                                            
                                        </ul>
                                    </div>
                                </td>
                                <td><?php echo strtoupper($value->produto); ?></td>
                                <td><?php echo $value->qtd; ?></td>
                                <td><?php echo $value->patrimonio; ?></td>
                                <td><?php echo $value->caixa; ?></td>
                                <td><?php echo $value->garantia; ?></td>
                                <td><?php echo $value->dt_cadastro; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Produto</th>
                            <th>QTD</th>
                            <th>Patrimônio</th>
                            <th>Caixa</th>
                            <th>Garantia</th>
                            <th>Entrada</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
    $(function () {
        $("#tb_estoque").DataTable({
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
        alertify.confirm('Mensagem', 'Realmente deseja excluir esse Produto?', function () {
            $.ajax({
                url: "<?php echo base_url('estoque/excluir'); ?>",
                type: "POST",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', "id": id},
                success: function () {
                    alertify.success('Produto excluído com Sucesso');
                    $('#' + id).remove();
                }
            });
        }
        , function () {

        });
    }

</script>