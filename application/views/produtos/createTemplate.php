<form method="post" class="form-horizontal" role="form">

  <div class="form-group">
    <label for="nome" class="col-sm-1 control-label">Nome</label>
    <div class="col-sm-11">
      <input id="nome" name="nome" type="text" class="form-control" placeholder="Digite o nome do produto">
    </div>
  </div>

  <div class="form-group">
    <label for="valor" class="col-sm-1 control-label">Valor</label>
    <div class="col-sm-11">
      <input id="valor" name="valor" type="text" class="form-control" placeholder="Digite o valor do produto">
    </div>
  </div>

  <div class="col-sm-offset-1">
    <a class="btn btn-primary" data-form-action="close" href="javascript:void(0)"><i class="fa fa-arrow-left"></i></a>
    <button type="submit" name="submit" class="btn btn-success" data-form-action="submit"><i class="fa fa-check"> Criar</i></button>
  </div>

</form>