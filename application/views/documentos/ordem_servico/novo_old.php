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

            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Produto</h3>
              </div>

              <div class="box-body" style="display: block;">

                <div class="form-group">
                  <label>Descrição</label>
                  <input type="text" class="form-control descricao" id="descricao" name="descricao" placeholder="Descrição">
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Patrimônio</label>
                      <input type="text" class="form-control" id="patrimonio" name="patrimonio" placeholder="Patrimônio">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Número de Série</label>
                      <input type="text" class="form-control" id="numero_serie" name="numero_serie" placeholder="Núm. Série">
                    </div>
                  </div>
                </div>

              </div>

            </div>

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
  } else if ($('#descricao').val() === '') {
    alertify.error('Campo Descrição Obrigatório');
    return false;
  } else {

    $.ajax({
      url: "<?php echo base_url('ordem_servico/save'); ?>",
      type: "POST",
      data: $('#novo').serialize(),
      success: function () {
        alertify.alert('Mensagem', 'Ordem de Serviço cadastrada com Sucesso', function () {
          location.href = '<?php echo base_url('ordem_servico'); ?>';
        });
      }
    });
  }

}

</script>
