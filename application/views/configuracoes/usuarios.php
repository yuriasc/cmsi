<style>
    table#tb_usuarios tr td .hoverbutton {
        visibility: hidden;
    }

    table#tb_usuarios tr:hover td .hoverbutton {
        visibility: visible
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Usuários
            <small>Painel de Controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('home'); ?>"> Configurações</a></li>
            <li class="active">Usuários</li>
        </ol>
    </section>

    <section class="content">
        <div class="pad">
            <a href="<?php echo base_url('configuracao/usuarios/novo'); ?>" type="button"
               class="btn btn-primary btn-flat">Novo Usuário
            </a>
        </div>
        <div class="box box-primary">
            <div class="box-body table-responsive" style="overflow-x: visible;">
                <table id="tb_usuarios" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Ativo</th>
                            <th>Último acesso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($usuarios as $value) {
                            $btn = ($value->n_ativo == '1') ? 'btn-primary' : 'btn-danger';
                            ?>
                            <tr id="<?php echo $value->id; ?>">
                                <td style="width: 5%">
                                    <div class="input-group-btn hoverbutton">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">Ações
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu" style="min-width: 50%;">
                                            <li>
                                                <a href="<?php echo base_url("configuracao/usuarios/atualizar/$value->id"); ?>">Atualizar</a>
                                            </li>
                                            <li><a onclick="excluir('<?php echo $value->id; ?>');">Excluir</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li>
                                                <a href="<?php echo base_url("configuracao/usuarios/permissoes/$value->id"); ?>">Permissões</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td><?php echo $value->nome; ?></td>
                                <td><?php echo $value->email; ?></td>
                                <td><?php echo $value->tipo; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-flat <?php echo $btn; ?>"
                                            onclick="ativar('<?php echo $value->id; ?>', this);"><?php echo $value->ativo; ?></button>
                                </td>
                                <td><?php echo $value->ultimo_acesso; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Ativo</th>
                            <th>Último acesso</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
    $(function () {
        $("#tb_usuarios").DataTable({
            "language": {
                "url": "<?php echo base_url('public/plugins/datatables/i18n/pt-br.json.js'); ?>"
            },
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });

    function ativar(id, btn) {

        var classe = btn.className.split(' ')[3];
        var buttom = (classe === 'btn-danger') ? 'btn-primary' : 'btn-danger';
        var texto = (classe === 'btn-danger') ? 'SIM' : 'NÃO';

        $.ajax({
            url: "<?php echo base_url('configuracao/usuarios/ativar'); ?>",
            type: "GET",
            data: {"id": id},
            success: function () {
                btn.classList.remove(classe);
                btn.classList.add(buttom);
                btn.innerHTML = texto;
                alertify.alert('Mensagem', 'Usuário ativado com Sucesso');
            }
        });
    }

    function excluir(id) {
        alertify.confirm().set('labels', {ok: 'SIM', cancel: 'NÃO'});
        alertify.confirm('Mensagem', 'Realmente deseja excluir esse Usuário?', function () {
            $.ajax({
                url: "<?php echo base_url('configuracao/usuarios/excluir'); ?>",
                type: "GET",
                data: {"id": id},
                success: function () {
                    alertify.success('Usuário excluído com Sucesso');
                    $('#' + id).remove();
                }
            });
        }
        , function () {

        });
    }

</script>