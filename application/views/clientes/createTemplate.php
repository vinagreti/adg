<form method="post" class="form-horizontal" role="form">

  <div class="form-group">
    <label for="nome" class="col-sm-1 control-label">Nome</label>
    <div class="col-sm-11">
      <input id="nome" name="nome" type="text" class="form-control" placeholder="Digite o nome do cliente">
    </div>
  </div>

  <div class="form-group">
    <label for="grupo_typeahead" class="col-sm-1 control-label">Grupo</label>
    <div class="col-sm-10">
      <input id="grupo_typeahead" type="text" class="form-control" placeholder="Digite o nome do grupo">
      <input id="grupo" name="grupo" type="hidden">
    </div>
  </div>

  <div class="col-sm-offset-1">
    <a class="btn btn-primary" data-form-action="close" href="javascript:void(0)"><i class="fa fa-arrow-left"></i></a>
    <button type="submit" name="submit" class="btn btn-success" data-form-action="submit"><i class="fa fa-check"> Criar</i></button>
  </div>

</form>

<script type="text/javascript">
  $('#grupo_typeahead').typeahead({
      name: 'Fornecedores'
      , valueKey : "nome"
      , remote : "grupos/?nome=%QUERY"
      , template: "<p>{{nome}}</p>"
      , engine: Hogan
  }).bind("typeahead:selected", function(res, obj, name) {
    $('#grupo').val(obj.id);;
  });
</script>