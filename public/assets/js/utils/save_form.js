$('#form-save').submit(function (e) {
    e.preventDefault();
    let tipo = $('#tipo').html();
    $.ajax({
        url: '/patrimonio/public/device/'+tipo,
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            if (result === 'success'){
                toastr["success"]('Patrimônio salvo!', "Sucesso");
                if(tipo == 'insert'){
                    setTimeout(function() {            
                        window.location.href = '/patrimonio/public/device';
                        }, 2000);
                } else {
                    setTimeout(function() {            
                        window.location.href = '/patrimonio/public/device';
                        }, 2000);
                }
                // $('#lista').load(location.href + " #lista");
            } else {
                toastr["error"](result, "Erro");
            }
        },
        error: function (result) {
            toastr["error"](result, "Erro");
        }
    });
});