<h1><small>Lançamentos</small></h1>

<div class="table-responsive">
    <table class="bostable table table-hover table-condensed table-stripped" id="tabelaLancamentos" data-url="<?=base_url()?>lancamentos/json">
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
            </tr>
        </tbody>
        <tfoot>
            <td colspan="10" class="text-center">Nenhum lançamento encontrado</td>
        </tfoot>
    </table>
</div>