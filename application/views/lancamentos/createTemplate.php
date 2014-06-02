<form method="post" class="form-horizontal" role="form">

  <div class="form-group">
    <label class="col-sm-1 control-label">Tipo</label>
    <div class="col-sm-11">
      <label class="radio-inline">
        <input type="radio" class="tipo" name="tipo" value="C" checked> Crédito / Venda
      </label>
      <label class="radio-inline">
        <input type="radio" class="tipo" name="tipo" value="D"> Débito / Compra
      </label>
    </div>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1" class="col-sm-1 control-label">Entrega</label>
    <div class="col-sm-3">
      <div class="input-group date" id="data_entrega" data-date="<?=date('d-m-Y')?>" data-date-format="mm-dd-yyyy">
        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
        <input class="form-control" type="text" name="data_entrega" readonly="" value="<?=date('d-m-Y')?>">
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
        <input class="form-control" type="text" name="data_pagamento" readonly="" value="<?=date('d-m-Y')?>">
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
      <input id="cliente" name="cliente" type="text" class="form-control" placeholder="Digite o nome do cliente">
    </div>
  </div>

  <div class="form-group">
    <label for="fornecedor" class="col-sm-1 control-label">Fornecedor</label>
    <div class="col-sm-11">
      <input id="fornecedor" name="fornecedor" type="text" class="form-control" placeholder="Digite o nome do fornecedor">
    </div>
  </div>

  <div class="form-group">
    <label for="produto" class="col-sm-1 control-label">Produto</label>
    <div class="col-sm-11">
      <input id="produto" name="produto" type="text" class="form-control" placeholder="Digite o nome do produto">
    </div>
  </div>

  <div class="form-group">
    <label for="preco_produto" class="col-sm-1 control-label">Preço</label>
    <div class="col-sm-11">
      <input id="preco_produto" name="preco_produto" type="text" class="form-control" placeholder="Preço do produto">
    </div>
  </div>

  <div class="form-group">
    <label for="quantidade" class="col-sm-1 control-label">Quantidade</label>
    <div class="col-sm-11">
      <input id="quantidade" name="quantidade" type="text" class="form-control" placeholder="Número de produtos" value="1">
    </div>
  </div>

  <div class="form-group">
    <label for="valor" class="col-sm-1 control-label">Valor</label>
    <div class="col-sm-11">
      <input id="valor" name="valor" type="text" class="form-control" placeholder="Valor do lançamento" value="0">
    </div>
  </div>

  <div class="form-group">
    <label for="desconto" class="col-sm-1 control-label">Desconto</label>
    <div class="col-sm-11">
      <input id="desconto" name="desconto" type="text" class="form-control" placeholder="Desconto" value="0">
    </div>
  </div>

  <div class="form-group">
    <label for="valor_final" class="col-sm-1 control-label">Valor final</label>
    <div class="col-sm-11">
      <input id="valor_final" name="valor_final" type="text" class="form-control" placeholder="Desconto" value="0" disabled>
    </div>
  </div>

  <div class="form-group">
    <label for="desc" class="col-sm-1 control-label">Descrição</label>
    <div class="col-sm-11">
      <textarea id="desc" name="desc" rows="3" class="form-control" placeholder="Descreva a transação"></textarea>
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
      , template: "<p>{{nome}} - {{valor}}</p>"
      , engine: Hogan
  });

  $('#fornecedor').typeahead({
      name: 'Fornecedores'
      , valueKey : "nome"
      , remote : "fornecedores/?nome=%QUERY"
      , template: "<p>{{nome}} - {{valor}}</p>"
      , engine: Hogan
  });

  $('#produto').typeahead({
      name: 'Produtos'
      , valueKey : "nome"
      , remote : "produtos/?nome=%QUERY"
      , template: "<p>{{nome}} - {{valor}}</p>"
      , engine: Hogan
  }).bind("typeahead:selected", function(res, obj, name) {
    $('#preco_produto').val(obj.valor);
    $('#valor').val(parseInt($('#quantidade').val())*obj.valor);
    $('#valor').change();
  });

  $('#quantidade').on('change', function(){
    $('#valor').val(parseInt($('#preco_produto').val())*parseInt(this.value));
    $('#valor').change();
  });

  $('#valor, #desconto').on('change', function(){
    $('#valor_final').val(parseInt($('#valor').val())-parseInt($('#desconto').val()));
  });

</script>