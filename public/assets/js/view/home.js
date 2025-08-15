// ========VARIÁVEIS BASE=============
var url = window.location.href;
var baseUrl = $('#base_url').html();

// ========INICIALIZAÇÃO=============
$(document).ready(function() {

});

function showPeriodo(periodo) {
    console.log(periodo);
    $('.mes_30').addClass('d-none');
    $('.mes_todos').addClass('d-none');
    $('.'+periodo).removeClass('d-none');
}


