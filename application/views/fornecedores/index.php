<h1><small>Fornecedore</small></h1>

<div class="table-responsive">
    <table class="bostable table table-hover table-condensed table-striped" id="tabelaFornecedore" data-url="<?=base_url()?>fornecedores">
        <caption>
            <span class="pull-left"><button class="btn btn-link" data-crud-create="<?=base_url()?>fornecedores/createTemplate"><i class="fa fa-plus fa-2x color-success"></i></button></span>
        </caption>
        <thead>
            <th ordenavel>Nome</th>
            <th class="col-sm-1">Ações</th>
        </thead>
        <tbody>
            <tr>
                <td class="nome"></td>
                <td><span class="menuLinhaTabela">
                    <button type="button" class="btn btn-info btn-xs editarUsuario" data-crud-read="<?=base_url()?>fornecedores/readTemplate" data-toggle="tooltip" title="Visualizar lançamento"><i class="fa fa-expand fa-1"></i></button>
                    <button type="button" class="btn btn-primary btn-xs editarUsuario" data-crud-update="<?=base_url()?>fornecedores/updateTemplate" data-toggle="tooltip" title="Editar lançamento"><i class="fa fa-edit fa-1"></i></button>
                    <button type="button" class="btn btn-danger btn-xs deletarUsuario" data-crud-drop="<?=base_url()?>fornecedores/dropTemplate" data-toggle="tooltip" title="Excluir lançamento"><i class="fa fa-trash-o fa-1"></i></button>
                </span></td>
            </tr>
        </tbody>
    </table>
</div>