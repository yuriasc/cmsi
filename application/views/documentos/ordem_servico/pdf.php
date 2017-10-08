<html>

<head>
  <title>OS: <?php echo $documento[0]->numero; ?></title>
  <style>
    body {
      font-family: Verdana, Geneva, sans-serif;
    }
    .espacamento {
      padding-bottom: 5px;
      font-weight: bold;
    }
  </style>
</head>

<body>

    <div class="imagem" style="text-align: center; padding-bottom: 10px;"><img src="<?php echo base_url('public/img/logo_ifpb.png'); ?>" style="width: 250px;"></div>

    <div class="titulo" style="text-align: center;">
      <div class="espacamento">DIREÇÃO GERAL DO CAMPUS JOÃO PESSOA</div>
      <div class="espacamento">DIRETORIA DE ADMINISTRAÇÃO</div>
      <div class="espacamento">COORDENAÇÃO DE MANUTENÇÃO E SUPERVISÃO DE INFORMÁTICA</div>
    </div>

    <div style="padding-top: 20px;">
      <div>OS n° <?php echo $documento[0]->numero; ?></div>
    </div>

    <div style="text-align: right; padding-top: 5px;">
      <div>João Pessoa,  <?php setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); echo strftime('%A, %d de %B de %Y', strtotime('today')); ?></div>
    </div>

    <div style="text-align: center; padding-top: 25px;">
      <b>ORDEM DE SERVIÇO</b>
    </div>

    <div style="text-align: justify; padding-top: 10px; text-indent: 3em;">
      <p>Recebi da Coordenação de Manutenção e Supervisão de Informática o seguinte equipamento de informática:</p>
    </div>

    <?php foreach ($itens as $value) { ?>

      <?php if ($value->descricao) { ?>
        <div>
          <div><b>Produto: </b><?php echo $value->descricao; ?></div>
        </div>
      <?php } ?>

      <?php if ($value->patrimonio) { ?>
        <div>
          <div><b>Patrimônio: </b><?php echo $value->patrimonio; ?></div>
        </div>
      <?php } ?>

      <?php if ($value->numero_serie) { ?>
        <div style="padding-bottom: 8px;">
          <div><b>Número de Série: </b><?php echo $value->numero_serie; ?></div>
        </div>
      <?php } ?>

      <?php if ($value->metros) { ?>
        <div style="padding-bottom: 8px;">
          <div><b>Metros: </b><?php echo $value->metros; ?></div>
        </div>
      <?php } ?>

      <?php if ($value->quantidade) { ?>
        <div style="padding-bottom: 8px;">
          <div><b>Quantidade: </b><?php echo $value->quantidade; ?></div>
        </div>
      <?php } ?>

    <?php } ?>

    <div style="padding-top: 20px;">
      <div><b>Serviço Prestado: <b></div>
      <div>
        <?php echo $documento[0]->laudo; ?>
      </div>
    </div>

    <div style="padding-top: 20px;">
      <div><b>Setor: </b><?php echo $documento[0]->setor; ?></div>
    </div>
    <div>
      <div><b>Responsável pélo Setor: </b><?php echo $documento[0]->responsavel; ?></div>
    </div>

    <div style="float: right; width: 50%">
      <div style="padding-top: 100px; text-align: center;">
        ___________________________________________________
      </div>
      <div style="text-align: center;">
        Assinatura do Responsável
      </div>
    </div>


</body>

</html>
