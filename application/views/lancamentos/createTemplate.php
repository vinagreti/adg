<form method="post" class="form-horizontal" role="form">

  <div class="form-group">
    <label class="col-sm-1 control-label">Tipo</label>
    <div class="col-sm-11">
      <label class="radio-inline">
        <input type="radio" class="tipo" name="tipo" value="c" checked> Crédito / Venda
      </label>
      <label class="radio-inline">
        <input type="radio" class="tipo" name="tipo" value="d"> Débito / Compra
      </label>
    </div>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1" class="col-sm-1 control-label">Entrega</label>
    <div class="col-sm-3">
      <div class="input-group date" id="data_entrega" data-date="<?=date('d-m-Y')?>" data-date-format="mm-dd-yyyy">
        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
        <input class="form-control input-sm input-sm" type="text" name="data_entrega" readonly="" value="<?=date('d-m-Y')?>">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="entregue"> Entrega realizada
        </label>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-1 control-label">Pagamento</label>
    <div class="col-sm-3">
      <div class="input-group date" id="data_pagamento" data-date="<?=date('d-m-Y')?>" data-date-format="mm-dd-yyyy">
        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
        <input class="form-control input-sm" type="text" name="data_pagamento" readonly="" value="<?=date('d-m-Y')?>">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="pago"> Pagamento realizado
        </label>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="cliente" class="col-sm-1 control-label">Cliente</label>
    <div class="col-sm-11">
      <input id="cliente" name="cliente" type="text" class="form-control input-sm" placeholder="Digite o nome do cliente">
    </div>
  </div>

  <div class="form-group">
    <label for="fornecedor" class="col-sm-1 control-label">Fornecedor</label>
    <div class="col-sm-11">
      <input id="fornecedor" name="fornecedor" type="text" class="form-control input-sm" placeholder="Digite o nome do fornecedor">
    </div>
  </div>

  <div class="form-group">
    <label for="produto" class="col-sm-1 control-label">Produto</label>
    <div class="col-sm-11">
      <input id="produto" name="produto" type="text" class="form-control input-sm" placeholder="Digite o nome do produto">
    </div>
  </div>

  <div class="form-group">
    <label for="quantidade" class="col-sm-1 control-label">Quantidade</label>
    <div class="col-sm-11">
      <input id="quantidade" name="quantidade" type="number" class="form-control input-sm" placeholder="Número de produtos">
    </div>
  </div>

  <div class="form-group">
    <label for="valor" class="col-sm-1 control-label">Valor</label>
    <div class="col-sm-11">
      <input id="valor" name="valor" type="text" class="form-control input-sm" placeholder="Valor do lançamento">
    </div>
  </div>

  <div class="form-group">
    <label for="desc" class="col-sm-1 control-label">Descrição</label>
    <div class="col-sm-11">
      <textarea id="desc" name="desc" rows="3" class="form-control input-sm" placeholder="Descreva a transação"></textarea>
    </div>
  </div>

  <a class="btn btn-primary" data-form-action="close" href="javascript:void(0)"><i class="fa fa-arrow-left"></i></a>
  <button type="submit" name="submit" class="btn btn-success" data-form-action="submit"><i class="fa fa-check"> Lançar</i></button>

</form>

<script type="text/javascript">
  $('#data_entrega, #data_pagamento').datepicker();

  $('#cliente').typeahead({
      name: 'Clientes'
      , valueKey : "nome"
      , remote : "clientes/?nome=%QUERY"
      , template: "<p>{{nome}}</p>"
      , engine: Hogan
  });

  $('#fornecedor').typeahead({
      name: 'Fornecedores'
      , valueKey : "nome"
      , remote : "fornecedores/?nome=%QUERY"
      , template: "<p>{{nome}}</p>"
      , engine: Hogan
  });

  $('#produto').typeahead({
      name: 'Produtos'
      , valueKey : "nome"
      , remote : "produtos/?nome=%QUERY"
      , template: "<p>{{nome}}</p>"
      , engine: Hogan
  });


</script>