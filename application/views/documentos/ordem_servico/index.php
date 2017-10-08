<style>
table#tb_documento tr td .hoverbutton {
  visibility: hidden;
}

table#tb_documento tr:hover td .hoverbutton {
  visibility: visible
}
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Lista de Ordens de Serviço
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Ordem de Serviço</li>
    </ol>
  </section>

  <section class="content">
    <div class="pad">
      <a href="<?php echo base_url('ordem_servico/novo'); ?>" type="button" class="btn btn-primary btn-flat">Nova Ordem de Serviço</a>
    </div>
    <div class="box box-primary">
      <div class="box-body table-responsive" style="overflow-x: visible;">
        <table id="tb_documento" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th></th>
              <th>OS</th>
              <th>Setor</th>
              <th>Responsável</th>
              <th>Item</th>
              <th>Laudo</th>
              <th>Criado por</th>
              <th>Criado em</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($documentos as $value) { ?>
              <tr id="<?php echo $value->id; ?>">
                <td style="width: 5%">
                  <div class="input-group-btn hoverbutton">
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                    data-toggle="dropdown" aria-expanded="false">Ações
                    <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu" style="min-width: 50%;">
                      <li><a onclick="imprimir('<?php echo $value->id; ?>');">Imprimir</a></li>
                      <li>
                        <a href="<?php echo base_url("ordem_servico/atualizar/$value->id"); ?>">Atualizar</a>
                      </li>
                      <li><a onclick="excluir('<?php echo $value->id; ?>');">Excluir</a></li>
                    </ul>
                  </div>
                </td>
                <td><?php echo $value->numero; ?></td>
                <td><?php echo $value->setor; ?></td>
                <td><?php echo $value->responsavel; ?></td>
                <td><button class="btn btn-sm btn-default" onclick="item('<?php echo $value->id; ?>')"> Item</sp  an></button></td>
                <td><button class="btn btn-sm btn-default" onclick="laudo('<?php echo $value->id; ?>')"> Laudo</span></button></td>
                <td><?php echo $value->nome; ?></td>
                <td><?php echo $value->dt_cadastro; ?></td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <th></th>
                <th>OS</th>
                <th>Setor</th>
                <th>Responsável</th>
                <th>Item</th>
                <th>Laudo</th>
                <th>Criado por</th>
                <th>Criado em</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="modal_laudo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title laudo_info_titulo"></h4>
        </div>
        <div class="modal-body">
          <div id="laudo_info"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_item">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title item_info_titulo"></h4>
        </div>
        <div class="modal-body">
          <div id="item_info"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
  $(function () {
    $("#tb_documento").DataTable({
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

  function imprimir(id) {
    var url = '<?php echo base_url('ordem_servico/imprimir'); ?>/' + id;
    window.open(url, '_blank');
  }

  function item(id) {
    $.ajax({
      url: "<?php echo base_url('ordem_servico/item'); ?>",
      type: "POST",
      data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', "id": id},
      dataType: 'JSON',
      success: function (data) {
        var linha = '';
        $('.item_info_titulo').text('Ordem de Serviço: ' + data[0].numero);
        $.each(data, function (i, value) {

          linha += '<div class="row">';
          linha += '<div class="col-md-12">';
          linha += '<dl>';
          linha += '<dt>Descrição</dt>';
          linha += '<dd>' + value.descricao + '</dd>';
          linha += '<dl>';
          linha += '</div>';
          linha += '</div>';

          linha += '<div class="row">';

          if (value.patrimonio) {
            linha += '<div class="col-md-3">';
            linha += '<dl>';
            linha += '<dt>Patrimônio</dt>';
            linha += '<dd>' + value.patrimonio + '</dd>';
            linha += '<dl>';
            linha += '</div>';
          }

          if (value.numero_serie) {
            linha += '<div class="col-md-3">';
            linha += '<dl>';
            linha += '<dt>Número de Série</dt>';
            linha += '<dd>' + value.numero_serie + '</dd>';
            linha += '<dl>';
            linha += '</div>';
          }

          if (value.metros) {
            linha += '<div class="col-md-3">';
            linha += '<dl>';
            linha += '<dt>Metros</dt>';
            linha += '<dd>' + value.metros + '</dd>';
            linha += '<dl>';
            linha += '</div>';
          }

          if (value.quantidade) {
            linha += '<div class="col-md-3">';
            linha += '<dl>';
            linha += '<dt>Quantidade</dt>';
            linha += '<dd>' + value.quantidade + '</dd>';
            linha += '<dl>';
            linha += '</div>';
          }

          linha += '</div>';
        });
        $('#item_info').html(linha);
        $('#modal_item').modal();
      }
    });
  }

  function laudo(id) {
    $.ajax({
      url: "<?php echo base_url('ordem_servico/laudo'); ?>",
      type: "POST",
      data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', "id": id},
      dataType: 'JSON',
      success: function (data) {
        $('.laudo_info_titulo').text('Ordem de Serviço: ' + data[0].numero);
        $('#laudo_info').text(data[0].laudo);
        $('#modal_laudo').modal();
      }
    });
  }

  function excluir(id) {
    alertify.confirm().set('labels', {ok: 'SIM', cancel: 'NÃO'});
    alertify.confirm('Mensagem', 'Realmente deseja excluir essa Ordem de Serviço?', function () {
      $.ajax({
        url: "<?php echo base_url('ordem_servico/excluir'); ?>",
        type: "POST",
        data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', "id": id},
        success: function () {
          alertify.success('Ordem de serviço excluído com Sucesso');
          $('#' + id).remove();
        }
      });
    }
    , function () {

    });
  }

  </script>
