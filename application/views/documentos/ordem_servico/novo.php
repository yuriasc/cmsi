<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Ordem de Serviço | Novo
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('ordem_servico'); ?>"> Ordem de Serviço</a></li>
      <li class="active">Novo</li>
    </ol>
  </section>

  <section class="content">

    <?php echo form_open('', 'id="novo"'); ?>

    <div class="box box-primary">
      <div class="box-body table-responsive" style="overflow-x: visible;">

        <div class="row">
          <div class="col-md-6">

            <div class="form-group">
              <label>Setor</label>
              <input type="text" class="form-control" id="setor" name="setor" placeholder="Setor">
            </div>

            <div class="form-group">
              <label>Responsável</label>
              <input type="text" class="form-control" id="responsavel" name="responsavel" placeholder="Responsável">
            </div>

            <div class="form-group">
              <label>Laudo</label>
              <textarea class="form-control" id="laudo" name="laudo" rows="5" placeholder="Laudo"></textarea>
            </div>

          </div>

          <div class="col-md-6">

            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Produto #1</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>

              <div class="box-body" style="display: block;">

                <div class="form-group">
                  <label>Descrição</label>
                  <input type="text" class="form-control descricao" id="descricao" name="descricao[]" placeholder="Descrição">
                </div>

                <div class="row listaItem_1">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Item</label>
                      <input type="text" class="form-control" value="1">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Patrimônio</label>
                      <input type="text" class="form-control" id="patrimonio" name="patrimonio_1[]" placeholder="Patrimônio">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Número de Série</label>
                      <input type="text" class="form-control" id="numero_serie" name="numero_serie_1[]" placeholder="Número de Série">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Metros</label>
                      <input type="text" class="form-control" id="metros" name="metros_1[]" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Quantidade</label>
                      <input type="text" class="form-control" id="quantidade" name="quantidade_1[]" placeholder="">
                    </div>
                  </div>
                </div>

                <div class="item_1"></div>

                <a type="button" class="btn btn-flat btn-default" onclick="addItem(1);"><i class="fa fa-plus"></i> Adicionar Item</a>

              </div>

            </div>

            <div class="lista"></div>

            <a type="button" class="btn btn-flat btn-default" onclick="addProduto();"><i class="fa fa-plus"></i> Adicionar Produto</a>

          </div>

        </div>

      </div>

      <div class="box-footer">
        <a type="button" class="btn btn-flat btn-primary" onclick="return novo();">Salvar</a>
      </div>
    </div>

    <?php echo form_close(); ?>

  </section>
</div>

<script>

function addProduto() {
  $('.lista').append(listaProduto());
}

function addItem(d) {
  $('.item_' + d).append(listaItem(d));
}

function novo() {

  if ($('#setor').val() === '') {
    alertify.error('Campo Setor Obrigatório');
    return false;
  } else if ($('#responsavel').val() === '') {
    alertify.error('Campo Responsável Obrigatório');
    return false;
  } else if ($('#laudo').val() === '') {
      alertify.error('Campo Laudo Obrigatório');
      return false;
  } else {

    var teste = true;

    $('.descricao').each(function(i, value) {
      var v = $(this).val();
      if (v == '') {
        alertify.error('Campo Descrição no Produto #' + ++i + ' Obrigatório');
        teste = false;
        return false;
      }
    });

    if (teste) {
      $.ajax({
        url: "<?php echo base_url('ordem_servico/save'); ?>",
        type: "POST",
        data: $('#novo').serialize(),
        success: function (data) {
          alertify.alert('Mensagem', 'Ordem de Serviço cadastrada com Sucesso', function () {
            var url = '<?php echo base_url('ordem_servico/imprimir'); ?>/' + data;
            window.open(url, '_blank');
            location.href = '<?php echo base_url('ordem_servico'); ?>';
          });
        }
      });
    }

  }
}

function listaItem(d) {
  var val = '';
  $('.listaItem_' + d).each(function(i, value) {
    val = ++i + 1;
  });

  var div = '';
  div = '<div class="row listaItem_' + d + '">' +
    '<div class="col-md-2">' +
      '<div class="form-group">' +
        '<label>Item</label>' +
        '<input type="text" class="form-control" value="' + val + '">' +
      '</div>' +
    '</div>' +
    '<div class="col-md-3">' +
      '<div class="form-group">' +
        '<label>Patrimônio</label>' +
        '<input type="text" class="form-control" id="patrimonio" name="patrimonio_' + d + '[]" placeholder="Patrimônio">' +
      '</div>' +
    '</div>' +
    '<div class="col-md-3">' +
      '<div class="form-group">' +
        '<label>Número de Série</label>' +
        '<input type="text" class="form-control" id="numero_serie" name="numero_serie_' + d + '[]" placeholder="Número de Série">' +
      '</div>' +
    '</div>' +
    '<div class="col-md-2">' +
      '<div class="form-group">' +
        '<label>Metros</label>' +
        '<input type="text" class="form-control" id="metros" name="metros_' + d + '[]" placeholder="">' +
      '</div>' +
    '</div>' +
    '<div class="col-md-2">' +
      '<div class="form-group">' +
        '<label>Quantidade</label>' +
        '<input type="text" class="form-control" id="quantidade" name="quantidade_' + d + '[]" placeholder="">' +
      '</div>' +
    '</div>' +
  '</div>';

  return div;
}

function listaProduto() {
  var Produto = '';
  $('.box').each(function(i, value) {
    Produto = ++i;
  });

  var div = '';
  var div = '<div class="box box-danger">' +
    '<div class="box-header with-border">' +
      '<h3 class="box-title">Produto #' + Produto + '</h3>' +
      '<div class="box-tools pull-right">' +
        '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>' +
        '</button>' +
      '</div>' +
    '</div>' +
    '<div class="box-body" style="display: block;">' +
      '<div class="form-group">' +
        '<label>Descrição</label>' +
        '<input type="text" class="form-control descricao" id="descricao" name="descricao[]" placeholder="Descrição">' +
      '</div>' +
      '<div class="row listaItem_' + Produto + '">' +
        '<div class="col-md-2">' +
          '<div class="form-group">' +
            '<label>Item</label>' +
            '<input type="text" class="form-control" value="1">' +
          '</div>' +
        '</div>' +
        '<div class="col-md-3">' +
          '<div class="form-group">' +
            '<label>Patrimônio</label>' +
            '<input type="text" class="form-control" id="patrimonio" name="patrimonio_' + Produto + '[]" placeholder="Patrimônio">' +
          '</div>' +
        '</div>' +
        '<div class="col-md-3">' +
          '<div class="form-group">' +
            '<label>Número de Série</label>' +
            '<input type="text" class="form-control" id="numero_serie" name="numero_serie_' + Produto + '[]" placeholder="Número de Série">' +
          '</div>' +
        '</div>' +
        '<div class="col-md-2">' +
          '<div class="form-group">' +
            '<label>Metros</label>' +
            '<input type="text" class="form-control" id="metros" name="metros_' + Produto + '[]" placeholder="">' +
          '</div>' +
        '</div>' +
        '<div class="col-md-2">' +
          '<div class="form-group">' +
            '<label>Quantidade</label>' +
            '<input type="text" class="form-control" id="quantidade" name="quantidade_' + Produto + '[]" placeholder="">' +
          '</div>' +
        '</div>' +
      '</div>' +
      '<div class="item_' + Produto + '"></div>' +
      '<a type="button" class="btn btn-flat btn-default" onclick="addItem(' + Produto + ');"><i class="fa fa-plus"></i> Adicionar Item</a>' +
      '</div>' +
    '</div>' +
  '</div>';

  return div;
}

</script>
