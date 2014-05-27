// Bostable
// Classe de criação e manipulação de tabelas
// Author: Bruno da Silva João
// https://github.com/vinagreti

// definindo como api do jquery
(function( $ ){

    $.fn.bostable = function() {

        var bostables = {}; // tabelas no escopo da tela

        // MAPEIA A TELA EM BUSCA DAS TABELAS COM CLASSE BOSTABLE
        // ================================
        var telaMapeada = false; // indica se a tela já foi mapeada

        if( telaMapeada === false ){ // se a tela ainda não foi mapeada

            // identifica todas as tabelas com classe bostable do documento
            var tabelas = $(document).find("table.bostable");

            // para cada tabela encontrada
            $.each( tabelas, function(i, tabela ){

                bostables[$(tabela).attr('id')] = new bostableClass( $(tabela) );

            });

            telaMapeada = true;

        }

        // CLASSE BOSTABLE
        // ================================
        function bostableClass( tabela ) {

            var self = this; // instancia a si mesmo para poder ser referenciado dentro de funções
            var total = 0; // total de iténs encontrados
            var pagina = 1; // número da página atual
            var por_pagina = 30; // númerod e itens por página
            var base_url_tabela = tabela.attr("data-url").replace(/\/\s*$/, "")+"/"; // uri base da tabela (insere / no fim da string)
            var pageData; // ítens da tabela

            // aplica a classe de ordenação na
            // $(function(){ tabela.tablesorter(); });

            // MAPEIA A TABELA
            // ======================
            var elementoLinha = tabela.find("tbody").find("tr").clone(); // copia a estrutura HTML da linha

            tabela.find("tbody").find("tr").remove(); // remove a linha modelo

            var elementoCaption = (tabela.find("caption").length > 0) ? tabela.find("caption").clone() : $('<caption>'); // copia a estrutura HTML do caption

            tabela.find("caption").remove(); // remove o caption

            var elementoTfooter = (tabela.find("tfoot").length > 0) ? tabela.find("tfoot").clone() : $('<tfoot>'); // copia a estrutura HTML do tfoot

            tabela.find("tfoot").remove(); // remove o tfoot

            $.each( tabela.find("th"), function( index, th ){ // configura o cabeçalho da tabela

                if (typeof $(th).attr("ordenavel") !== 'undefined' && $(th).attr("ordenavel") !== false) { // se tiverem o atributo "ordenavel"

                    $(th).css("cursor", 'pointer'); // torna o cabeçalho clicável

                    $(th).append(' <i class="fa fa-sort"></i>'); // insere icones de sort no cabeçalho das colunas

                }

            });

            // APLICA OS GATILHOS NOS BOTOES DE AÇÕES DE CRUD DAS TABELAS
            // ================================
            function aplicarGatilhosTabela(){

                tabela.find('[data-crud-create]').unbind('click').on('click', function(){

                    var form_url = $(this).attr('data-crud-create');

                    self.abrirCreateform( form_url );

                });

                tabela.find('[data-crud-update]').unbind('click').on('click', function(){

                    var form_url = $(this).attr('data-crud-update');

                    self.abrirUpdateform( form_url );

                });

                tabela.find('[data-crud-read]').unbind('click').on('click', function(){

                    var form_url = $(this).attr('data-crud-read');

                    self.abrirReadform( form_url );

                });

            }
            self.aplicarGatilhosTabela = aplicarGatilhosTabela;

            // APLICA OS GATILHOS NOS BOTOES DE AÇÕES DE CRUD DOS FORMULÁRIOS
            // ================================
            function aplicarGatilhosForm( method ){

                tabela.find('[data-form-action*="close"]').unbind('click').on('click', function(){

                    tabela.html(self.tablePageContent);

                    aplicarGatilhosTabela();

                });

                tabela.find('form').on('submit', function( e ){

                    e.preventDefault();

                    var formData = $(this).serialize();

                    $[method]( base_url_tabela, formData )
                    .success(function( res ){

                        pageData.push(res);

                        tabela.html(self.tablePageContent);

                        inserirLinha( res );

                        aplicarGatilhosTabela();

                    });

                    return false;

                })

            }
            self.aplicarGatilhosForm = aplicarGatilhosForm;

            // PEGA OS DADOS NA API REST
            // ================================
            function carrega( page, per_page ){

                page = page ? page : pagina;

                per_page = per_page ? per_page : por_pagina;

                footer('<p class="text-center"><i class="fa fa-spin fa-circle-o-notch fa-2x"></i></p>');

                $.get( base_url_tabela+'?page='+page+'&per_page='+per_page )
                .success(function( res, textStatus, request ){

                    pageData = res;

                    total = request.getResponseHeader('X-Total-Count');

                    self.atualizarPaginacao();

                    $.each( res, function( index, obj ){

                        self.inserirLinha( obj );

                    });

                    aplicarGatilhosTabela();

                })
                .fail(function( res ){

                    footer( res.msg );

                });

            };
            carrega();
            self.carrega = carrega;

            // ATUALIZA A BARRA DE PAGINAÇÃO
            // ================================
            function atualizarPaginacao(){

                if(total == 0)
                    tabela.find("tfoot").html(defaultFoot);

                else{

                    pagina = pagina ? parseInt(pagina) : 1;

                    por_pagina = por_pagina ? parseInt(por_pagina) : 30;

                    var totalPaginas = Math.ceil(total / por_pagina);

                    if( totalPaginas > 1 ){

                        var paginacao = '<div class="text-center"><ul class="pagination">';

                        paginacao += '<li><a href="'+base_url_tabela+'?pagina=1&por_pagina='+por_pagina+'">&laquo;</a></li>';

                        paginacao += '<li><a href="'+base_url_tabela+'?pagina='+(pagina > 2 ? pagina - 1 : 1)+'&por_pagina='+por_pagina+'">&lt;</a></li>';

                        for (var i = 1; i <= totalPaginas; i++) {
                            paginacao += '<li class="'+ (i == pagina ? 'active' : '') + '"><a href="'+base_url_tabela+'?pagina='+i+'&por_pagina='+por_pagina+'">'+i+' <span class="sr-only">(current)</span></a></li>';
                        };

                        paginacao += '<li><a href="'+base_url_tabela+'?pagina='+ ((pagina < totalPaginas) ? (pagina+1) : pagina) +'&por_pagina='+por_pagina+'">&gt;</a></li>';

                        paginacao += '<li><a href="'+base_url_tabela+'?pagina='+ totalPaginas +'&por_pagina='+por_pagina+'">&raquo;</a></li>';

                        paginacao += '</ul></div>';

                        footer( $(paginacao ) );

                    } else {

                        footer( '' );

                    }

                    var posicaoPrimeiroItem = total > 0 ? (pagina * por_pagina) + 1 - por_pagina : 0;

                    var posicaoSegundoItem = (posicaoPrimeiroItem + por_pagina - 1) > total ? total : posicaoPrimeiroItem + por_pagina -1;

                    var totalresumeHTML = $(document.createElement('span')).html("Mostrando do " + posicaoPrimeiroItem + "&ordm até o " + posicaoSegundoItem + "&ordm de " + total + " registro(s) encontrado(s).");

                    var captionContent = $(document.createElement('small')).addClass('text-info').append( totalresumeHTML );

                    self.caption( captionContent );

                }

            }
            self.atualizarPaginacao = atualizarPaginacao;

            // ATUALIZA O RODAPÉ
            // ================================
            function footer( conteudo ){

                tabela.find('tfoot').remove();

                var footer = elementoTfooter.clone();

                content = $('<tr>').html( $('<td>').attr('colspan',elementoLinha.find('td').length).html( conteudo ) );

                tabela.append( footer.append( content ) );

            }
            self.footer = footer;

            // ATUALIZA O TITULO DA TABELA
            // ================================
            function caption( content ){

                var caption = elementoCaption.clone();

                tabela.find('caption').remove();

                tabela.prepend( caption.append( content ) );

                aplicarGatilhosTabela();

            }
            self.caption = caption;

            // INSERE UMA LINHA NA TABELA TENDO COMO BASE UM OBJETO JSON
            // ================================
            function inserirLinha( objeto, pos, highlight ){

                // define a posição da nova linha
                var pos = ( pos === "append" || pos === "prepend" ) ? pos : "append";

                // cria uma nova linha da tabela
                var linha = elementoLinha.clone();

                // define o identificador da nova linha
                linha.attr("id", objeto.id );

                // para cada atributo do objeto
                $.each( objeto, function( attribute, value ){

                    var elemento = linha.find( "." + attribute );

                    if( elemento.length > 0 ){

                        // preenche a respectiva coluna da linha com seu valor
                        elemento.html( value );

                        if( elemento.get(0).tagName == "IMG" ){

                            elemento.attr("src", value );

                            elemento.wrap( "<a href='"+value+"' target='_blank'></a>" );

                        }

                    }

                });

                // se a opção highlight estiver setada como true
                if( highlight ){

                    // cria um efeito visual na nova linha
                    linha.addClass("success");

                    // após 4 segundos
                    setTimeout(function(){

                        // remove o efeito visual da nova linha
                        linha.removeClass("success");

                    },2400);

                };

                // insere a nova linha na tabela
                linha.hide()[pos+"To"]( tabela.find("tbody") ).fadeIn( "slow" );

                // atualiza a classe de orednação
                self.atualizaOrdenacao();

            };
            self.inserirLinha = inserirLinha;

            // REMOVE UMA LINHA DA TABELA TENDO COMO REFERÊNCIA SEU IDENTIFICADOR (ID)
            // ================================
            function removerLinha( id ){

                // instancia a linha da tabela
                var linha = tabela.find( "#" + id );

                // insere um efeito na linha
                linha.addClass("danger");

                // apaga a linha lentamente
                linha.fadeOut("slow", function(){

                    // remove a linha da tabela
                    linha.remove();

                    // atualiza a classe de orednação
                    self.atualizaOrdenacao();

                });

            };
            self.removerLinha = removerLinha;

            // ATUALIZA A ORDENAÇÃO DA TABELA
            // ================================
            function atualizaOrdenacao(){

                var resort = true, callback = function(table){};

                tabela.trigger("update", [resort, callback]);

            };
            self.atualizaOrdenacao = atualizaOrdenacao;

            // INSERE UMA LINHA NA TABELA TENDO COMO BASE UM OBJETO JSON
            // ================================
            function editarLinha( objeto ){

                // instancia a linha da tabela
                var linha = tabela.find("#"+objeto.id);

                // para cada atributo do objeto
                $.each( objeto, function( attribute, value ){

                    var elemento = linha.find( "." + attribute );

                    if( elemento.length > 0 ){

                        // preenche a respectiva coluna da linha com seu valor
                        elemento.html( value );

                        if( elemento.get(0).tagName == "IMG" ){

                            elemento.attr("src", value );

                        }

                    }

                });

                // cria um efeito visual na linha editada
                linha.addClass("success");

                // após 4 segundos
                setTimeout(function(){

                    // remove o efeito visual da linha editada
                    linha.removeClass("success");

                },2400);

                // atualiza a classe de orednação
                self.atualizaOrdenacao();

            };
            self.editarLinha = editarLinha;

            // LIMPA A TABELA
            // ================================
            function limpar(){

                tabela.find("tbody").empty();

                tabela.find("tfoot").remove();

                tabela.find("caption").remove();

            }
            self.limpar = limpar;

            function showForm( form, method ){

                self.tablePageContent = tabela.html();

                tabela.html($(form));

                aplicarGatilhosForm( method );

            }

            // ABRE O FORMULÁRIO PARA CRIAÇÃO DE NOVO ITEM
            // ================================
            function abrirCreateform( form_url ){

                $.get( form_url )
                .success(function(form){

                    showForm( form, 'post' );

                })
                .fail(function(res){
                    abrirCreateform();
                });

            }
            self.abrirCreateform = abrirCreateform;

            // ABRE O FORMULÁRIO PARA CRIAÇÃO DE NOVO ITEM
            // ================================
            function abrirUpdateform( form_url ){

                $.get( form_url )
                .success(function(res){
                    console.log('res');
                })
                .fail(function(res){
                    abrirUpdateform();
                });

            }
            self.abrirUpdateform = abrirUpdateform;

            // ABRE O FORMULÁRIO PARA CRIAÇÃO DE NOVO ITEM
            // ================================
            function abrirReadform( form_url ){

                $.get( form_url )
                .success(function(res){
                    console.log('res');
                })
                .fail(function(res){
                    abrirReadform();
                });

            }
            self.abrirReadform = abrirReadform;
        };

        return this;

    }();

})( jQuery );