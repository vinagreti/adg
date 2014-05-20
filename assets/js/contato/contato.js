$("#contatoForm").on('submit', function( e ){

    e.preventDefault();

    $.ajax({
      type: "POST",
      url: base_url+"contato/enviar",
      data: {assunto:$("#assunto").val(), mensagem:$("#mensagem").val()},
      success: function( res ){

        if( res.success ){

            alert( res.msg );

        } else {

            alert( res.msg );

        }

      },
      dataType: 'json'
    });

    return false;

});