<h2><small>Criar lançamento</small></h2>

<form class="form-horizontal" role="form">

  <div class="form-group">
    <label class="col-sm-2 control-label">Tipo</label>
    <div class="col-sm-10">
      <label class="radio-inline">
        <input type="radio" class="tipo" name="tipo" value="C" checked> Crédito / Venda
      </label>
      <label class="radio-inline">
        <input type="radio" class="tipo" name="tipo" value="D"> Débito / Compra
      </label>
    </div>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1" class="col-sm-2 control-label">Entrega</label>
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
    <label class="col-sm-2 control-label">Pagamento</label>
    <div class="col-sm-3">
      <div class="input-group date" id="data_pagamento" data-date="<?=date('d-m-Y')?>" data-date-format="mm-dd-yyyy">
        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
        <input class="form-control" type="text" name="data_pagamento" readonly="" value="<?=date('d-m-Y')?>">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="realizado"> Pagamento realizado
        </label>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="cliente_typeahead" class="col-sm-2 control-label">Cliente</label>
    <div class="col-sm-10">
      <input id="cliente_typeahead" type="text" class="form-control" placeholder="Digite o nome do cliente">
      <input id="cliente" name="cliente" type="hidden">
    </div>
  </div>

  <div class="form-group hide">
    <label for="fornecedor_typeahead" class="col-sm-2 control-label">Fornecedor</label>
    <div class="col-sm-10">
      <input id="fornecedor_typeahead" type="text" class="form-control" placeholder="Digite o nome do fornecedor">
      <input id="fornecedor" name="fornecedor" type="hidden">
    </div>
  </div>

  <div class="form-group">
    <label for="produto_typeahead" class="col-sm-2 control-label">Produto</label>
    <div class="col-sm-10">
      <input id="produto_typeahead" type="text" class="form-control" placeholder="Digite o nome do produto">
      <input id="produto" name="produto" type="hidden">
    </div>
  </div>

  <div class="form-group">
    <label for="preco_produto" class="col-sm-2 control-label">Preço</label>
    <div class="col-sm-10">
      <input id="preco_produto" name="preco_produto" type="text" class="form-control" placeholder="Preço do produto">
    </div>
  </div>

  <div class="form-group">
    <label for="quantidade" class="col-sm-2 control-label">Quantidade</label>
    <div class="col-sm-10">
      <input id="quantidade" name="quantidade" type="text" class="form-control" placeholder="Número de produtos" value="1">
    </div>
  </div>

  <div class="form-group">
    <label for="valor" class="col-sm-2 control-label">Valor</label>
    <div class="col-sm-10">
      <input id="valor" name="valor" type="text" class="form-control" placeholder="Valor do lançamento" value="0">
    </div>
  </div>

  <div class="form-group">
    <label for="desconto" class="col-sm-2 control-label">Desconto</label>
    <div class="col-sm-10">
      <input id="desconto" name="desconto" type="text" class="form-control" placeholder="Desconto" value="0">
    </div>
  </div>

  <div class="form-group">
    <label for="valor_final" class="col-sm-2 control-label">Valor final</label>
    <div class="col-sm-10">
      <input id="valor_final" name="valor_final" type="text" class="form-control" placeholder="Desconto" value="0" disabled>
    </div>
  </div>

  <div class="form-group">
    <label for="desc" class="col-sm-2 control-label">Descrição</label>
    <div class="col-sm-10">
      <textarea id="desc" name="desc" rows="3" class="form-control" placeholder="Descreva a transação"></textarea>
    </div>
  </div>

  <div class="col-sm-offset-2">
    <a class="btn btn-primary" data-form-action="close" href="javascript:void(0)"><i class="fa fa-arrow-left"></i></a>
    <button type="submit" name="submit" class="btn btn-success" data-form-action="submit"><i class="fa fa-check"> Lançar</i></button>
  </div>

</form>

<script type="text/javascript">
  $('#data_entrega, #data_pagamento').datepicker();

  $('#cliente_typeahead').typeahead({
      name: 'Clientes'
      , valueKey : "nome"
      , remote : "clientes/?nome=%QUERY"
      , template: "<p>{{nome}}</p>"
      , engine: Hogan
  }).bind("typeahead:selected", function(res, obj, name) {
    $('#cliente').val(obj.id);;
  });

  $('#fornecedor_typeahead').typeahead({
      name: 'Fornecedores'
      , valueKey : "nome"
      , remote : "fornecedores/?nome=%QUERY"
      , template: "<p>{{nome}}</p>"
      , engine: Hogan
  }).bind("typeahead:selected", function(res, obj, name) {
    $('#fornecedor').val(obj.id);;
  });

  $('#produto_typeahead').typeahead({
      name: 'Produtos'
      , valueKey : "nome"
      , remote : "produtos/?nome=%QUERY"
      , template: "<p>{{nome}} - {{valor}}</p>"
      , engine: Hogan
  }).bind("typeahead:selected", function(res, obj, name) {
    $('#produto').val(obj.id);;
    $('#preco_produto').val(obj.valor);
    $('#valor').val(parseFloat($('#quantidade').val())*obj.valor);
    $('#valor').change();
  });

  $('#quantidade').on('change', function(){
    $('#valor').val(parseFloat($('#preco_produto').val())*parseFloat(this.value));
    $('#valor').change();
  });

  $('#valor, #desconto').on('change', function(){
    $('#valor_final').val(parseFloat($('#valor').val())-parseFloat($('#desconto').val()));
  });

  $(".tipo").on( "change", function() {
    $('#fornecedor').parents('.form-group').removeClass('hide');
    if($('.tipo:checked').val() == 'C'){
      $('#cliente').parents('.form-group').show();
      $('#fornecedor').parents('.form-group').val('').hide();
    } else{
      $('#fornecedor').parents('.form-group').show();
      $('#cliente').parents('.form-group').val('').hide();
    }
  });

</script>