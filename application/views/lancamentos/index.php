<h1><small>Lançamentos</small></h1>

<div class="table-responsive">
    <table class="bostable table table-hover table-condensed table-stripped" id="tabelaLancamentos" data-url="<?=base_url()?>lancamentos">
        <caption>
            caption definido na view
            <span class="pull-left"><button class="btn btn-link" data-crud-create="<?=base_url()?>lancamentos/createTemplate"><i class="fa fa-plus fa-2x color-success"></i></button></span>
        </caption>
        <thead>
            <th ordenavel>Tipo</th>
            <th ordenavel>Qtd</th>
            <th ordenavel>Produto</th>
            <th ordenavel>Unidade</th>
            <th ordenavel>Estimado</th>
            <th ordenavel>Cobrado</th>
            <th ordenavel>Cliente</th>
            <th ordenavel>Fornecedor</th>
            <th ordenavel>Desc</th>
            <th ordenavel>Realizado</th>
            <th ordenavel>Data</th>
            <th class="col-sm-1">Ações</th>
        </thead>
        <tbody>
            <tr>
                <td class="tipo"></td>
                <td><span class="quantidade"></span>x</td>
                <td class="produto"></td>
                <td class="valor_unidade"></td>
                <td class="valor_estimado"></td>
                <td class="valor_cobrado"></td>
                <td class="cliente"></td>
                <td class="fornecedor"></td>
                <td class="descricao"></td>
                <td class="realizado"></td>
                <td class="data"></td>
                <td><span class="menuLinhaTabela">
                    <button type="button" class="btn btn-info btn-xs editarUsuario" data-crud-read="<?=base_url()?>lancamentos/readTemplate" data-toggle="tooltip" title="Visualizar lançamento"><i class="fa fa-expand fa-1"></i></button>
                    <button type="button" class="btn btn-primary btn-xs editarUsuario" data-crud-update="<?=base_url()?>lancamentos/updateTemplate" data-toggle="tooltip" title="Editar lançamento"><i class="fa fa-edit fa-1"></i></button>
                    <button type="button" class="btn btn-danger btn-xs deletarUsuario" data-crud-drop="<?=base_url()?>lancamentos/dropTemplate" data-toggle="tooltip" title="Excluir lançamento"><i class="fa fa-trash-o fa-1"></i></button>
                </span></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="12">
                    <p class="text-center">
                        rodapé definido na view
                    </p>
                </td>
            </tr>
        </tfoot>
    </table>
</div>