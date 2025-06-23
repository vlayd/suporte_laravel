// ========VARIÁVEIS BASE=============
var url = window.location.href;
var baseUrl = $('#base_url').html();

// ========INICIALIZAÇÃO=============
$(document).ready(function() {

});

function showPeriodo(pediodo) {
    console.log(pediodo);
    $('.mes_30').addClass('d-none');
    $('.mes_todos').addClass('d-none');
    $('.'+pediodo).removeClass('d-none');
}


