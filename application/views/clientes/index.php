<h1><small>Clientes</small></h1>

<div class="table-responsive">
    <table class="bostable table table-hover table-condensed table-striped" id="tabelaClientes" data-url="<?=base_url()?>clientes">
        <caption>
            <span class="pull-left"><button class="btn btn-link" data-crud-create="<?=base_url()?>clientes/createTemplate"><i class="fa fa-plus fa-2x color-success"></i></button></span>
        </caption>
        <thead>
            <th ordenavel>Nome</th>
            <th ordenavel>Grupo</th>
            <th class="col-sm-1">Ações</th>
        </thead>
        <tbody>
            <tr>
                <td class="nome"></td>
                <td class="nome_grupo"></td>
                <td><span class="menuLinhaTabela">
                    <button type="button" class="btn btn-info btn-xs editarUsuario" data-crud-read="<?=base_url()?>clientes/readTemplate" data-toggle="tooltip" title="Visualizar lançamento"><i class="fa fa-expand fa-1"></i></button>
                    <button type="button" class="btn btn-primary btn-xs editarUsuario" data-crud-update="<?=base_url()?>clientes/updateTemplate" data-toggle="tooltip" title="Editar lançamento"><i class="fa fa-edit fa-1"></i></button>
                    <button type="button" class="btn btn-danger btn-xs deletarUsuario" data-crud-drop="<?=base_url()?>clientes/dropTemplate" data-toggle="tooltip" title="Excluir lançamento"><i class="fa fa-trash-o fa-1"></i></button>
                </span></td>
            </tr>
        </tbody>
    </table>
</div>